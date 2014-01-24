using System;
using System.Collections.Generic;
using System.IO;
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

namespace PromptingDiaryRoom
{
    /// <summary>
    /// Interaction logic for DiaryContentPage.xaml
    /// </summary>
    public partial class DiaryContentPage : Page
    {
        public DiaryContentPage()
        {
            InitializeComponent();
        }

        private void Page_Loaded_1(object sender, RoutedEventArgs e)
        {
            DiarySession session = (Application.Current as App).Session;
            string file = "";

            do
            {
                file = session.GetRandom();
            }
            while(session.View(file) && file != "");

            if (file == "")
            {
                NavigationService.Navigate(new FinishedPage());
            }
            else
            {
                string folderPath = Path.Combine(session.OutputPath, session.NumViewed.ToString());
                Directory.CreateDirectory(folderPath);

                string extension = Path.GetExtension(file);
                string name = "content" + extension;
                string to = Path.Combine(folderPath, name);
                File.Copy(file, to);

                if (file.EndsWith(".mp4"))
                {
                    PromptLabel.Content = session.GetRandomQuestion("video");
                    VideoPlayer.Source = new Uri(file);

                    ImageViewer.Visibility = Visibility.Collapsed;
                    VideoPlayer.Visibility = Visibility.Visible;
                }
                else
                {
                    PromptLabel.Content = session.GetRandomQuestion("picture");

                    BitmapImage image = new BitmapImage();
                    image.BeginInit();
                    image.UriSource = new Uri(file);
                    image.EndInit();

                    ImageViewer.Source = image;
                    ImageViewer.Visibility = Visibility.Visible;
                    VideoPlayer.Visibility = Visibility.Collapsed;
                }

                SoundRecorder recorder = (Application.Current as App).Recorder;
                recorder.StartRecording(folderPath, "sound.wma");
            }
        }

        private void NextButton_Click_1(object sender, RoutedEventArgs e)
        {
            SoundRecorder recorder = (Application.Current as App).Recorder;
            if (recorder.IsRecording)
            {
                recorder.StopRecording();
            }

            DiarySession session = (Application.Current as App).Session;
            if (session.NumViewed > session.Max)
            {
                NavigationService.Navigate(new FinishedPage());
            }
            else
            {
                NavigationService.Navigate(new DiaryContentPage());
            }
        }
    }
}
