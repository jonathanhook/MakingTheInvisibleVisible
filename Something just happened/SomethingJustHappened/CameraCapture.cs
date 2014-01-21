using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;
using System.Threading;
using System.Windows;
using System.Net;
using System.Diagnostics;

using Microsoft.Expression.Encoder.Devices;
using Microsoft.Expression.Encoder.Live;
using Microsoft.Expression.Encoder;

namespace SomethingJustHappened
{
    public class CameraCapture
    {
        public string CurrentVideoPath { get; private set; }
        public EncoderDevice Video { get; set; }
        public EncoderDevice Audio { get; set; }
        public bool IsRecording { get; private set; }

        private LiveDeviceSource dvs;
        private LiveJob job;

        public CameraCapture(EncoderDevice video, EncoderDevice audio)
        {
            this.Video = video;
            this.Audio = audio;
        }

        public void StartRecording(string path, string name)
        {            
            job = new LiveJob();
            dvs = job.AddDeviceSource(Video, Audio);
            job.ActivateSource(dvs);
            job.ApplyPreset(LivePresets.VC1HighSpeedBroadband16x9);

            CurrentVideoPath = Path.Combine(path, name);

            FileArchivePublishFormat fileOut = new FileArchivePublishFormat();
            fileOut.OutputFileName = CurrentVideoPath;

            job.PublishFormats.Add(fileOut);
            job.StartEncoding();

            IsRecording = true;
        }

        public void StopRecording()
        {
            job.StopEncoding();
            job.RemoveDeviceSource(dvs);

            IsRecording = false;
        }
    }
}