using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace SomethingJustHappened
{
    public static class VideoTrimmer
    {
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

            string args = string.Format("-i \"{0}\" -ss {1} -y \"{2}\"", input, start, output);

            Console.WriteLine(args);

            ProcessStartInfo pInfo = new ProcessStartInfo();
            pInfo.FileName = FFMPEG;
            pInfo.Arguments = args;
            pInfo.UseShellExecute = false;
            pInfo.RedirectStandardOutput = true;
            pInfo.RedirectStandardError = true;

            Process p = new Process();
            p.StartInfo = pInfo;
            p.OutputDataReceived += p_OutputDataReceived;
            p.ErrorDataReceived += p_ErrorDataReceived;
            p.Start();
            p.BeginOutputReadLine();
            p.BeginErrorReadLine();
        }

        private static void p_ErrorDataReceived(object sender, DataReceivedEventArgs e)
        {
            if (e.Data != null)
            {
                Console.Write("ERROR:\t");
                Console.WriteLine(e.Data);
            }
        }

        private static void p_OutputDataReceived(object sender, DataReceivedEventArgs e)
        {
            if (e.Data != null)
            {
                Console.Write("STD-OUT:\t");
                Console.WriteLine(e.Data);
            }
        }

        private static TimeSpan GetVideoDuration(string video)
        {
            ProcessStartInfo pInfo = new ProcessStartInfo();
            pInfo.FileName = FFMPEG;
            pInfo.Arguments = string.Format("-i {0}", video);
            pInfo.UseShellExecute = false;
            pInfo.RedirectStandardError = true;

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
