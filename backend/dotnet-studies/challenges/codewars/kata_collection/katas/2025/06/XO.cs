namespace katas._2025._06
{
    /*
     Check to see if a string has the same amount of 'x's and 'o's. The method must return a boolean and be case insensitive. The string can contain any char.

    Examples input/output:

    XO("ooxx") => true
    XO("xooxx") => false
    XO("ooxXm") => true
    XO("zpzpzpp") => true // when no 'x' and 'o' is present should return true
    XO("zzoo") => false
     */
    public static class XO
    {
        public static bool CountXO(string input)
        {
            var array = input.ToLower().ToCharArray();
            if (array.Where(x => x.Equals('x')).Count() == array.Where(x => x.Equals('o')).Count())
                return true;
            else
                return false;
        }
        // return input.ToLower().Count(i => i == 'x') == input.ToLower().Count(i => i == 'o'); BEST PRACTICE
    }
}
