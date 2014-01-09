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
            List<EncoderDevice> audioDevices = DeviceFinder.GetAudioDevices();

            camera = new SomethingJustHappenedCamera(videoDevices[0], audioDevices[0], Environment.GetFolderPath(Environment.SpecialFolder.MyVideos), TimeSpan.FromSeconds(3));
            camera.Start();
        }

        private void Window_KeyDown_1(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Escape)
            {
                camera.Stop();
                this.Close();
            }
        }

        private void Window_MouseDown_1(object sender, MouseButtonEventArgs e)
        {
            ClickedLabel.Visibility = Visibility.Visible;
            camera.Click();
            ClickedLabel.Visibility = Visibility.Collapsed;
        }
    }
}
