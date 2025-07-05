using System.Reflection.Metadata.Ecma335;

namespace katas._2025._06
{
    internal class OutlierNumber
    {
        public static int Find(int[] integers)
        {
            
            var odd = integers.Where(x => x % 2 == 0);
            var even = integers.Where(x => x % 2 != 0);

            if (odd.Count() > 1)
                return even.First();
            else
                return odd.First();
        }
    }
}
