using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace SomethingJustHappened
{
    public static class VideoTrimmer
    {
        public delegate void ProcessorOutputEventHandler(string message);
        public static event ProcessorOutputEventHandler ProcessorOutputEvent;

        private const string FFMPEG = "ffmpeg.exe";

        public static void TrimVideo(string input, string output, TimeSpan clipDuration)
        {
            TimeSpan sourceDuration = GetVideoDuration(input);
            TimeSpan start = TimeSpan.FromSeconds(0);
            
            if (clipDuration < sourceDuration)
            {
                start = sourceDuration - clipDuration;
                start = new TimeSpan(start.Hours, start.Minutes, start.Seconds);
            }
            else
            {
                clipDuration = sourceDuration;
            }

            string args = string.Format("-i {0} -ss {1} -t {2} -y {3}", input, start, clipDuration, output);

            Console.WriteLine();
            Console.WriteLine(args);
            Console.WriteLine();

            ProcessStartInfo pInfo = new ProcessStartInfo();
            pInfo.FileName = FFMPEG;
            pInfo.Arguments = args;
            //pInfo.UseShellExecute = false;
            //pInfo.RedirectStandardOutput = true;
            //pInfo.RedirectStandardError = true;
            //pInfo.CreateNoWindow = true;

            Process p = new Process();
            p.StartInfo = pInfo;
            p.Start();
            p.WaitForExit();

            /*
            string errorStr = p.StandardError.ReadToEnd();
            string outputStr = p.StandardOutput.ReadToEnd();

            if (errorStr.Length > 0)
            {
                Console.WriteLine("ERROR");
                Console.WriteLine(errorStr);
            }

            Console.WriteLine(outputStr);*/
        }

        private static TimeSpan GetVideoDuration(string video)
        {
            ProcessStartInfo pInfo = new ProcessStartInfo();
            pInfo.FileName = FFMPEG;
            pInfo.Arguments = string.Format("-i {0}", video);
            pInfo.UseShellExecute = false;
            pInfo.RedirectStandardError = true;
            pInfo.CreateNoWindow = true;

            Process p = new Process();
            p.StartInfo = pInfo;
            p.Start();
            p.WaitForExit();
            
            string error = p.StandardError.ReadToEnd();
            string durationStr = Regex.Match(error, "Duration:.*?,", RegexOptions.None).Value;
            durationStr = durationStr.Replace("Duration: ", "");
            durationStr = durationStr.Replace(",", "");

            return TimeSpan.Parse(durationStr);
        }
    }
}
