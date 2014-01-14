using Microsoft.Expression.Encoder.Devices;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Threading;

namespace SomethingJustHappened
{
    class SomethingJustHappenedCamera
    {
        public delegate void ProcessorOutputEventHandler(object sender, string message);
        public static event ProcessorOutputEventHandler ProcessorOutputEvent;

        private const string CLIP_FORMAT = "click_{0}.avi";
        private const string SEGMENT_FORMAT = "segment_{0}.wmv";

        public TimeSpan ClipLength { get; set; }

        private CameraCapture camera;
        private string path;
        private string folder;
        private bool processingClick;
        private int segmentCount;

        public SomethingJustHappenedCamera(EncoderDevice video, EncoderDevice audio, string path, TimeSpan clipLength)
        {
            this.path = path;
            this.ClipLength = clipLength;

            processingClick = false;
            segmentCount = 0;

            folder = EscapePath(DateTime.UtcNow.ToString());
            this.path = Path.Combine(path, folder);

            if (!Directory.Exists(this.path))
            {
                Directory.CreateDirectory(this.path);
            }

            camera = new CameraCapture(video, audio);

            //VideoTrimmer.ProcessorOutputEvent += VideoTrimmer_ProcessorOutputEvent;
        }

        private void VideoTrimmer_ProcessorOutputEvent(string message)
        {
            if (ProcessorOutputEvent != null)
            {
                ProcessorOutputEvent(this, message);
            }
        }

        public void Start()
        {
            string filename = string.Format(SEGMENT_FORMAT, segmentCount);
            camera.StartRecording(path, filename);
        }

        public void Stop()
        {
            camera.StopRecording();
        }

        public void Click()
        {
            if (!processingClick)
            {
                processingClick = true;

                if (camera.IsRecording)
                {
                    camera.StopRecording();

                    int clickSegmentNumber = segmentCount;
                    string segmentPath = camera.CurrentVideoPath;

                    Thread t = new Thread(() =>
                    {
                        string clickFilename = string.Format(CLIP_FORMAT, clickSegmentNumber);
                        string clickFilePath = Path.Combine(path, clickFilename);
                        VideoTrimmer.TrimVideo(segmentPath, clickFilePath, ClipLength);
                    });
                    t.Start();

                    string filename = string.Format(SEGMENT_FORMAT, ++segmentCount);
                    camera.StartRecording(path, filename);
                }

                processingClick = false;
            }
        }

        private string EscapePath(string path)
        {
            string escPath = path;
            escPath = escPath.Replace(':', '-');
            escPath = escPath.Replace('/', '-');
            escPath = escPath.Replace(' ', '_');

            return escPath;
        }
    }
}
