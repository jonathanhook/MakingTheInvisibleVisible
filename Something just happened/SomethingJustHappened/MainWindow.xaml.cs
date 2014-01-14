using Microsoft.Expression.Encoder.Devices;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace SomethingJustHappened
{
    public partial class MainWindow : Window
    {
        private SomethingJustHappenedCamera camera;
        private List<EncoderDevice> videoDevices;
        private List<EncoderDevice> audioDevices;
        private int currentVideoDevice;
        private int currentAudioDevice;
        private bool running;

        public MainWindow()
        {
            InitializeComponent();

            videoDevices = DeviceFinder.GetVideoDevices();
            audioDevices = DeviceFinder.GetAudioDevices();

            if (videoDevices.Count > 0 && audioDevices.Count > 0)
            {
                string defaultVideoName = Properties.Settings.Default.DefaultVideoDevice;
                string defaultAudioName = Properties.Settings.Default.DefaultAudioDevice;

                currentVideoDevice = DeviceFinder.FindDeviceByName(defaultVideoName, videoDevices);
                currentAudioDevice = DeviceFinder.FindDeviceByName(defaultAudioName, audioDevices);

                if (currentVideoDevice < 0)
                {
                    currentVideoDevice = 0;
                }

                if (currentAudioDevice < 0)
                {
                    currentAudioDevice = 0;
                }

                AudioDeviceLabel.Content = audioDevices[currentAudioDevice].Name;
                VideoDeviceLabel.Content = videoDevices[currentVideoDevice].Name;

                running = false;
            }
            else
            {
                MessageBox.Show("No audio and video devices available");
            }

            SomethingJustHappenedCamera.ProcessorOutputEvent += SomethingJustHappenedCamera_ProcessorOutputEvent;
        }

        private void SomethingJustHappenedCamera_ProcessorOutputEvent(object sender, string message)
        {
            Dispatcher.Invoke(new Action(() =>
            {
                ProcessorLabel.Content = message;
            }));   
        }

        private void Window_KeyDown_1(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Escape)
            {
                if (running)
                {
                    camera.Stop();
                }

                this.Close();
            }
            else if (e.Key == Key.V)
            {
                currentVideoDevice = (currentVideoDevice + 1) % videoDevices.Count;
                string name = videoDevices[currentVideoDevice].Name;

           
                VideoDeviceLabel.Content = name;
                Properties.Settings.Default.DefaultVideoDevice = name;
                Properties.Settings.Default.Save();
            }
            else if (e.Key == Key.A)
            {
                currentAudioDevice = (currentAudioDevice + 1) % audioDevices.Count;
                string name = audioDevices[currentAudioDevice].Name;

                AudioDeviceLabel.Content = name;
                Properties.Settings.Default.DefaultAudioDevice = name;
                Properties.Settings.Default.Save();
            }
            else if(e.Key == Key.Space)
            {
                if (!running)
                {
                    string path = System.IO.Path.Combine(Environment.GetFolderPath(Environment.SpecialFolder.MyVideos), Properties.Settings.Default.DataFolder);

                    camera = new SomethingJustHappenedCamera(videoDevices[currentVideoDevice], audioDevices[currentAudioDevice], path, Properties.Settings.Default.DefaultClipLength);
                    camera.Start();
                    RecordingLabel.Visibility = Visibility.Visible;

                    running = true;
                }
                else
                {
                    RecordingLabel.Visibility = Visibility.Hidden;
                    camera.Stop();

                    running = false;
                }
            }
        }

        private void Window_MouseDown_1(object sender, MouseButtonEventArgs e)
        {
            if (running)
            {
                ClickedLabel.Visibility = Visibility.Visible;
                camera.Click();
                ClickedLabel.Visibility = Visibility.Collapsed;
            }
        }
    }
}
