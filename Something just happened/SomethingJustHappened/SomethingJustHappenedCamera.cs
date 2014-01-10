using Microsoft.Expression.Encoder.Devices;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Threading;

namespace SomethingJustHappened
{
    class SomethingJustHappenedCamera
    {
        private const string CLIP_FILENAME = "{0}_{1}.wmv";
        private const string TEMP_FILENAME = "temp.wmv";

        public DateTime StartTime { get; private set; }
        public TimeSpan ClipLength { get; set; }

        private CameraCapture camera;
        private string path;
        private bool processingClick;

        public SomethingJustHappenedCamera(EncoderDevice video, EncoderDevice audio, string path, TimeSpan clipLength)
        {
            this.path = path;
            this.ClipLength = clipLength;

            processingClick = false;
            camera = new CameraCapture(video, audio);
        }

        public void Start()
        {
            camera.StartRecording(path, TEMP_FILENAME);
            StartTime = DateTime.UtcNow;
        }

        public void Stop()
        {
            camera.StopRecording();
            File.Delete(camera.CurrentVideoPath);
        }

        public void Click()
        {
            if (!processingClick)
            {
                processingClick = true;

                if (camera.IsRecording)
                {
                    camera.StopRecording();

                    string clickPath = GetClickFilePath();
                    File.Copy(camera.CurrentVideoPath, clickPath);

                    VideoTrimmer.TrimVideo(clickPath, clickPath.Replace("wmv", "avi"), ClipLength);

                    File.Delete(camera.CurrentVideoPath);
                    File.Delete(clickPath);

                    camera.StartRecording(path, TEMP_FILENAME);
                }

                processingClick = false;
            }
        }

        private string GetClickFilePath(string optional = "")
        {
            string startString = StartTime.ToString();
            startString = startString.Replace(':', '-');
            startString = startString.Replace('/', '-');
            startString = startString.Replace(' ', '_');

            TimeSpan elapsed = DateTime.UtcNow - StartTime;
            string filename = string.Format(CLIP_FILENAME, startString, (int)elapsed.TotalSeconds);
            return Path.Combine(path, (optional + filename));
        }
    }
}
