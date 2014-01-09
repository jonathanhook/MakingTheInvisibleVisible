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

        public MainWindow()
        {
            InitializeComponent();

            List<EncoderDevice> videoDevices = DeviceFinder.GetVideoDevices();
            foreach(EncoderDevice d in videoDevices)
            {
                VideoDevices.Items.Add(d.Name);
            }
            VideoDevices.SelectedIndex = 0;

            List<EncoderDevice> audioDevices = DeviceFinder.GetAudioDevices();
            foreach(EncoderDevice d in audioDevices)
            {
                AudioDevices.Items.Add(d.Name);
            }
            AudioDevices.SelectedIndex = 0;

            camera = new SomethingJustHappenedCamera(videoDevices[0], audioDevices[0], Environment.GetFolderPath(Environment.SpecialFolder.MyVideos), TimeSpan.FromSeconds(3)); 
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            camera.Click();
        }

        private void StartButton_Click(object sender, RoutedEventArgs e)
        {
            StartButton.IsEnabled = false;
            StopButton.IsEnabled = true;
            VideoDevices.IsEnabled = false;
            AudioDevices.IsEnabled = false;
            ClickButton.IsEnabled = true;
            
            camera.Start();
        }

        private void StopButton_Click(object sender, RoutedEventArgs e)
        {
            StartButton.IsEnabled = true;
            StopButton.IsEnabled = true;
            VideoDevices.IsEnabled = true;
            AudioDevices.IsEnabled = true;
            ClickButton.IsEnabled = false;

            camera.Stop();
        }

        private void ClickButton_Click(object sender, RoutedEventArgs e)
        {
            camera.Click();
        }

        private void VideoDevices_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            //throw new NotImplementedException();
        }

        private void AudioDevices_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            //throw new NotImplementedException();
        }
    }
}
