<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<h1>Calendar Types: Solar, Lunar and Lunisolar Calendars</h1>

<p>There are 3 basic calendar types: solar, lunar and lunisolar. This page discusses the difference
  and explains why a solar calendar is probably best for Earth.</p>

<p>&nbsp;</p>

<h2>Months</h2>

<p>Lunar and lunisolar calendars use <em>lunations</em> as calendar months, whereas solar calendars
  define calendar months as a fraction of the year that are only approximately equal to one
  lunation. A lunation is the average length of the synodic month, the time between new moons, equal
  to about 29.53 days. Months in lunar and lunisolar calendars therefore use patterns of months 29
  and 30 days in length to maintain this average.</p>
<p>In a solar calendar with 12 months, the average month length is 365.24 &divide; 12 = 30.44 days.
  Months in these types of calendars, as most of us will be familiar with from the Gregorian, are
  either 30 or 31 days long (not counting February, the freak month).</p>
<p>If a solar calendar has 13 months (e.g. the <a href="http://en.wikipedia
.org/wiki/Positivist_calendar" target="_blank">Positivist Calendar</a>) then these are usually 28
  days long each, and occasionally 29, to maintain an average length of 365.24 &divide; 13 = 28.1
  days. The main convenience of a 13-month solar calendar is that almost all months are exactly
  equal to 4 &times; 7-day weeks (see <a href="Months.php">Months</a> for more info).</p>
<p>&nbsp;</p>
<h2>Calendar Year Length</h2>
<p>In a <em>solar </em>calendar the intention is to organise the calendar year to synchronise with
  the seasonal cycle. This is most usually measured as the average time between successive northern
  vernal equinoxes, equal to 365.2424 days (called the<em> vernal equinox year</em>). The northern
  vernal equinox is the most commonly used seasonal marker to define a year's beginning because it
  marks the beginning of spring in the northern hemisphere. Spring is generally perceived as a time
  of new beginnings, and most people (certainly most people who have been involved in calendar
  design) live in the northern hemisphere.</p>
<p>Since calendars are a way of tracking days, each calendar year naturally has a whole number of
  days. Thus, solar calendars typically define patterns of years 365 and 366 days in length in order
  to produce an average length of about 365.24 days.</p>
<p>In a <em>lunar </em>calendar, such as the Islamic, the calendar year is defined as 12 lunations,
  about 354.36 days on average. This is about 11 days shorter than the vernal equinox year, and
  hence the seasonal markers tend to shift in the calendar, occuring about 11 days later each year.
  This can be a problem in agriculture, tourism and other industries that revolve around seasons.
</p>
<p><em>Lunisolar </em>calendars solve this problem by introducing an intercalary month (also called
  an &quot;embolismic&quot; month) every 2 or 3 years, so that the average year length matches the
  seasonal cycle. As 365.24 &divide; 29.53 = 12.37 lunations, some years thus have 12 months
  (lunations) = 354.36 days (avg.), and others have 13 lunations = 383.39 days.</p>
<p>The result is a calendar that keeps in synch with both the Sun and the Moon. This would seem
  ideal, and several important calendars take this approach, including the Chinese, Hebrew and
  Buddhist Calendars. However, this arrangement is generally less convenient than a solar calendar,
  as will be explained below.</p>
<p>&nbsp;</p>
<h2>Which is Best?</h2>
<p>If ever wondering if a lunisolar calendar is better than a solar calendar, think about this: why
  did the most populous nation on Earth, China, adopt the solar Gregorian Calendar in favour of its
  traditional lunisolar calendar?</p>
<p>There are several reasons why a solar calendar is superior to a lunar or lunisolar calendar.</p>
<h3>Synchronicity with Seasons</h3>
<p>Seasons are the most important cycle on Earth, since they are directly related to plant growth
  and hence food production, something that is of interest to almost all living creatures on the
  planet.</p>
<p>Before the Gregorian Calendar was adopted for official business in China in 1912, Chinese farmers
  used a <em>solar</em> calendar alongside the traditional lunisolar one. This second calendar was
  aligned with the seasons, and divided the year into 24 equal parts called <a
    href="http://en.wikipedia.org/wiki/Solar_terms" target="_blank">solar terms</a>. It existed
  primarily for the benefit of farmers, who need to be able to track progress through the seasonal
  cycle so they know when to sow, when to reap, and so on.</p>
<p>This illustrates that a lunisolar calendar is not enough by itself - a method for accurately
  tracking Earth's position in the seasonal cycle will always be required.</p>
<p>The lunar cycle does play a large part in life on Earth, being related to the female menstrual
  cycle, tides, behaviours of certain plants, and those special evenings when werewolves roam the
  land. So there is certainly some benefit to being aware of the lunar cycle, which is why lunisolar
  calendars persist, and why most printed solar calendars show lunar phases. However, they are not
  of critical importance to most people living on Earth. (They would, however, be very important to
  people living on the Moon - see &quot;Humans on the Moon&quot;, below.)</p>
<h3>Birthdates and Anniversaries - The Leap Baby Problem</h3>
<p>In most Earth calendars we generally record birthdays and other anniversaries using, not the day
  of the year, but the month and the day of the month. Because each day of the year is identified by
  a day and month, we know a year (or thereabouts) has passed every time that combination of day and
  month occurs again. This is, of course, one of the main uses of dates.</p>
<p>So, what happens if you're born on February 29? People born on this date are called <em>leap
    babies</em>, because February 29 only occurs in leap years. If you're a leap baby, what do you
  do for your birthday on those years without a February 29? This is the leap baby problem.</p>
<p>Most leap babies celebrate their birthdays in non-leap years on either February 28 or March 1.
  This is a minor issue affecting just 0.07% of people, and it's no big deal to have your birthday
  on the date before or after the actual date you were born.</p>
<p>However, consider how much larger this problem becomes when using a lunisolar calendar. Some
  years have 12 months, and others have 13. Imagine if you were born in that extra 13th month, as
  <sup>7</sup>/<sub>235</sub> or 3% of people would be (assuming a constant birth rate). In a year
  with only 12 months, when would you celebrate your bithday?</p>
<p>In the Hebrew Calendar the problem is solved as follows: In a 12-month year there is a month
  called Adar, but in a 13-month year there are two Adars: Adar I and Adar II. Whether you are born
  in Adar, Adar I or Adar II, in 12-month years your birthday is celebrated in Adar. Hence, if you
  are born early in Adar II, in 12-month years you would actually celebrate your birthday before
  your friend who was born in late Adar I.</p>
<p>This is not the end of the leap baby problem in the Hebrew Calendar either. If you are born on 30
  Adar I, then in a non-leap year you celebrate your birthday on 1 Nisan, because in a non-leap year
  Adar only has 29 days - much the same situation as in the Gregorian Calendar.</p>
<p>Clearly the leap baby problem is much worse in a lunisolar calendar. Furthermore, because of the
  varying year lengths, sometimes when your birthday occurs only 354 days have passed, and other
  times 383 have passed. This is obviously a much less accurate way of measuring the passing of
  years.</p>
<p>Some calendars, such as the <a href="http://www.newearthcalendar.com/index.shtml"
    target="_blank">New Earth Calendar</a>, use an intercalary week, in which case only 0.38% of
  people are affected by the leap baby problem. This is obviously an improvement on a lunisolar
  calendar, but still not as good as a solar calendar, plus there is not the benefit of being
  aligned with the lunar cycle. (The primary benefit of this type of calendar is that it is
  perpetual, yet does not disrupt the 7-day cycle.)</p>
<h3>Moons</h3>
<p>While our Moon is an important part of life on Earth, planetary satellites and their orbital
  periods are not anywhere near as important to a planetary civilization as the Sun and its orbital
  period are. In fact, it's really just a fortunate coincidence that Earth has a large natural
  satellite with an orbital period of a useful duration that could potentially be incorporated into
  a calendar. Other planets don't have this feature.</p>
<p>Planets can have no moons, or many moons, but they all have one primary star that gives life to
  that world. If a planet has no moon (e.g. Mercury or Venus), then there would be no question of
  incorporating the cycles of planetary satellites into the calendar. If a planet has many moons
  (e.g. Jupiter or Saturn) then it becomes too complex.</p>
<p>For example, the next planet (not counting the Moon itself) to be inhabited by humans will be
  Mars. Mars's moons have orbital periods of about 0.3 and 1.3 <a
    href="http://en.wikipedia.org/wiki/Timekeeping_on_Mars#Sols" target="_blank">sols</a>, so there
  is really no benefit to be gained from incorporating these cycles into a martian calendar.
  However, the seasonal cycle will be central to Mars's primary industry, i.e. tourism, along with
  other facets of martian culture such as agriculture, energy production and scientific research. <a
    href="http://www.martiantime.net/" target="_blank">Martian calendars</a> are always based around
  the martian solar year.</p>
<p>On most worlds other than Earth, a solar calendar is the only option. (Although, on many worlds,
  such as Luna and Venus, the calendar is more likely to be based around the solar <em>day</em>
  rather than the solar <em>year</em>.)</p>
<p>&nbsp;</p>
<h2>Humans on the Moon</h2>
<p>Possibly one of the more compelling (yet less obvious) arguments for a lunisolar calendar for
  Earth is that in the not-too-distant future, people will be living on the Moon.</p>
<p>By the end of this century there is likely to be an established permanent human presence on the
  Moon, with numerous human settlements, and supporting a local economy built on tourism, sport,
  energy, mining, materials and manufacturing.</p>
<p>What sort of calendar will <em>they</em> use?</p>
<p>For people living on Luna, the lunar cycle of 29.53 days will be the most important cycle in
  their lives, as central to their time-keeping systems as the day is to people on Earth. From the
  perspective of the Moon, a lunation is the time between sunrises.</p>
<p>The lunar daytime is completely different from the lunar night. For one thing, the temperature
  during the 2-week lunar day becomes extremely hot, up to a boiling 396K (123&deg;C), before
  plummeting to a mind-numbingly chilly 40K (-213&deg;C) during the 2-week night. Much of the lunar
  equipment will likely be solar powered (since it is notoriously difficult to burn diesel fuel in a
  vacuum, and besides, there probably isn't any oil), and hence will only function during the day.
  Most tourism, exploration, mining and engineering and scientific research will be done during the
  lunar day.</p>
<p>So people living on the Moon will <em>definitely </em>use lunar months as the basis for their
  calendar. The lunar cycle will be much more important to them than Earth's day, Earth's year, or
  any other astronomical cycle. There are no seasons on Luna.</p>
<p>People living on the Moon will probably use artificial days equal in length to Earth's days (that
  is, until we genetically engineer humans that can stay awake or asleep for 2 weeks at a time).
  Thus, a calendar for the Moon will, naturally, be lunar or lunisolar. People living on the Moon
  may simply adopt an existing lunisolar calendar like the traditional Chinese or Hebrew.</p>
<p>Luna's culture will be highly integrated with Earth's, and the degree of communications, trade
  and transport between the two worlds will increase exponentially as we progress through the space
  colonisation era. A thriving lunar community and economy on the Moon means a continuous flow of
  people travelling to and from Earth. We can compare the future Earth-Moon system to Earth today -
  once it took months to travel between continents, yet now thousands of people do it every day.
  Within a few decades it will be the same between Earth and the Moon.</p>
<p>Consider this high degree of interaction, wouldn't it be convenient if we all used the same
  calendar?</p>
<p>However, the fact remains that, for Earth, a solar calendar is better, primarily because of the
  relative simplicity. The population of the Moon will probably never exceed a tiny fraction of
  Earth's, and hence it is not super-critical to make the calendars the same. It is much more
  important that the people of Earth have the best possible calendar. In any case, even if we have
  to use two calendars for two worlds, instead of just one, this would still be a massive
  improvement over the multitude of calendars currently in use on Earth today.</p>
<p>&nbsp;</p>
<?php
require "tpl/TemplateBottom.php";
?>
