using Microsoft.Expression.Encoder;
using Microsoft.Expression.Encoder.Devices;
using Microsoft.Expression.Encoder.Live;
using Microsoft.Expression.Encoder.Profiles;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PromptingDiaryRoom
{
    public class SoundRecorder
    {
        public bool IsRecording { get; private set; }

        private EncoderDevice audioEncoder;
        private LiveDeviceSource dvs;
        private LiveJob job;

        public SoundRecorder(EncoderDevice audioEncoder)
        {
            this.audioEncoder = audioEncoder;
            IsRecording = false;
        }

        public string StartRecording(string path, string name)
        {
            job = new LiveJob();
            dvs = job.AddDeviceSource(null, audioEncoder);
            job.ActivateSource(dvs);

            WindowsMediaOutputFormat outputFormat = new WindowsMediaOutputFormat()
            {
                AudioProfile = new WmaAudioProfile()
            };

            job.OutputFormat = outputFormat;
            
            string currentRecordingPath = Path.Combine(path, name);
            FileArchivePublishFormat fileOut = new FileArchivePublishFormat();
            fileOut.OutputFileName = currentRecordingPath;

            job.PublishFormats.Add(fileOut);
            job.StartEncoding();

            IsRecording = true;

            return currentRecordingPath;
        }

        public void StopRecording()
        {
            job.StopEncoding();
            job.RemoveDeviceSource(dvs);

            IsRecording = false;
        }
    }
}
