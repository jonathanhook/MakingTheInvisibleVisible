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
using System.Windows.Threading;

namespace PromptingDiaryRoom
{
    /// <summary>
    /// Interaction logic for Finished.xaml
    /// </summary>
    public partial class FinishedPage : Page
    {
        public FinishedPage()
        {
            InitializeComponent();
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
            Restart();
        }

        private void Restart()
        {
            if (NavigationService != null)
            {
                NavigationService.Navigate(new WelcomePage());
            }
        }
    }
}
