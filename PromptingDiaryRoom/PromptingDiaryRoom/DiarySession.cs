﻿using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PromptingDiaryRoom
{
    public class DiarySession
    {
        public string ContentPath { get; private set; }
        public string OutputPath { get; private set; }
        public int NumViewed { get; private set; }
        public List<string> Viewed { get; private set; }
        public int Max { get; private set; }
        public DateTime Started { get; private set; }
        public string SessionName { get; private set; }

        private Random rand;

        public DiarySession()
        {
            Max = Properties.Settings.Default.ItemsToView;
            ContentPath = Properties.Settings.Default.ContentPath;
            OutputPath = Properties.Settings.Default.OutputPath;

            Viewed = new List<string>();
            NumViewed = 0;
            Started = DateTime.UtcNow;
            SessionName = EscapePath(Started.ToString());
            rand = new Random(DateTime.UtcNow.Hour);

            OutputPath = Path.Combine(OutputPath, SessionName);
        }

        public string GetRandom()
        {
            IEnumerable<string> files = Directory.EnumerateFiles(ContentPath);
            if (files.Count() > 0)
            {
                int index = rand.Next(0, files.Count());
                return files.ElementAt<string>(index);
            }
            else
            {
                return "";
            }
        }

        public bool View(string item)
        {
            if(Viewed.Contains(item))
            {
                return true;
            }
            else
            {
                Viewed.Add(item);
                NumViewed++;

                return false;
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
