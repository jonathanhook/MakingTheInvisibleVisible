using Microsoft.Expression.Encoder.Devices;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PromptingDiaryRoom
{
    static class DeviceFinder
    {
        public static List<EncoderDevice> GetAudioDevices()
        {
            int numAudioDevices = EncoderDevices.FindDevices(EncoderDeviceType.Audio).Count;
            if (numAudioDevices > 0)
            {
                return new List<EncoderDevice>(EncoderDevices.FindDevices(EncoderDeviceType.Audio));
            }
            else return new List<EncoderDevice>();
        }

        public static List<EncoderDevice> GetVideoDevices()
        {
            int numVideoDevices = EncoderDevices.FindDevices(EncoderDeviceType.Video).Count;
            if (numVideoDevices > 0)
            {
                return new List<EncoderDevice>(EncoderDevices.FindDevices(EncoderDeviceType.Video));
            }
            else return new List<EncoderDevice>();
        }

        public static int FindDeviceByName(string name, List<EncoderDevice> devices)
        {
            for (int i = 0; i < devices.Count; i++)
            {
                EncoderDevice d = devices[i];
                if (d.Name == name)
                {
                    return i;
                }
            }

            return -1;
        }
    }
}