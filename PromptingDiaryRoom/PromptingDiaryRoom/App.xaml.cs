using Microsoft.Expression.Encoder.Devices;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Threading.Tasks;
using System.Windows;

namespace PromptingDiaryRoom
{
    /// <summary>
    /// Interaction logic for App.xaml
    /// </summary>
    public partial class App : Application
    {
        public DiarySession Session { get; private set; }
        public SoundRecorder Recorder { get; private set; }

        public App()
        {
            List<EncoderDevice> audioEncoders = DeviceFinder.GetAudioDevices();
            if (audioEncoders.Count > 0)
            {
                Recorder = new SoundRecorder(audioEncoders[0]);
            }
            else
            {
                MessageBox.Show("Error: no audio devices found to record diary entries");
                Environment.Exit(0);
            }
        }

        public void StartDiarySession()
        {
            Session = new DiarySession();
        }
    }
}
