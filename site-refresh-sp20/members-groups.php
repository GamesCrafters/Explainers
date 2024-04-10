<?php require "common.inc" ?>
<!doctype html>
<html>
<head>
    <?php renderHead("Members") ?>
</head>
<body>
    <?php renderLogoAndNav() ?>
    <?php include "members-sidebar.inc" ?>
    <div id="page-content-members-groups" class="page-content">
        <div class="page-content-wrapper">
            <?php

            function renderFigure($caption, $src, $srcOnHover = NULL) {
                ?><figure class="size-mid">
                    <img src="<?= "/members/group/main/" . $src ?>"
                         <?= !empty($srcOnHover) ? "data-src-on-hover=\"/members/group/main/$srcOnHover\"" : ""  ?>
                         alt="<?= $caption ?>">
                    <figcaption hidden><?= $caption ?></figcaption>
                </figure><?php
            }

            function renderNames($row, $namesString) {
                $names = explode(",", $namesString);
                $processedNames = [];
                foreach ($names as $name) {
                    $processedNames[] = str_replace(' ', '&nbsp;', trim($name));
                }
                echo "<strong>$row</strong>: ";
                if (count($processedNames) == 1) {
                    echo $processedNames[0];
                } else {
                    $lastName = array_pop($processedNames);
                    echo implode(", ", $processedNames);
                    echo ",&nbsp;";
                    echo $lastName;
                }
            }

            ?>
            <h3>The Fall 2023 GamesCrafters</h3>
            <?php renderFigure("The Fall 2023 GamesCrafters", "GamesCrafters2023Fa.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Steve Chen, Siddharth Shashi, Mehul Gandhi, Amy Chakladar, Jatearoon 'Keene' Boondicharern, Shangdian 'King' Han, Eric Garcia") ?><br>
                <?php renderNames("Third Row", "Chenyang 'Mia' Mao, Zhiyao 'Jessica' Jiang") ?><br>
                <?php renderNames("Second Row", "Diyun Lu, Bruce Kim, Abraham Hsu, Alvaro Estrella, Pranay Rajpaul, Xinyu Tang") ?><br>
                <?php renderNames("Front Row", "Robert Shi, Nakul Srikanth, Ethan Tam, Dan Garcia, Ricky Liu, Arihant Choudhary") ?><br>
            </p>
            <hr>
            <h3>The Spring 2023 GamesCrafters</h3>
            <?php renderFigure("The Spring 2023 GamesCrafters", "GamesCrafters2023Sp.jpg") ?>
            <p>
                <?php renderNames("Back Row (Standing)", "Nakul Srikanth, Christopher Nammour, Hoanan Huang, Andrew Lee, Zachary Leete, Dan Garcia, Ethan Chang, Harnoor Dhillon, Andrew Esteban, Sameer Nayyar, Eric Garcia, Shangdian 'King' Han, Rachel Hu, Jennifer Buja") ?><br>
                <?php renderNames("Front Row (Kneeling)", "Yifan Zhou, Jiachun Li, Robert Shi, Cameron Cheung, Jatearoon 'Keene' Boondicharern, Victoria Phelps, Arihant Choudhary, Max Fierro") ?><br>
                <?php renderNames("Not Pictured", "Amy Chakladar, Kayla Kranen, Lucas Gagne, Maansi Singh, Nayna Siddharth, Pranav Sukumar, Samhith Kakarla, SeongHyun Park, Siddharth Ganapathy, Srinija Cherivirala, Stefanie Gschwind") ?><br>
            </p>
            <hr>
            <h3>The Fall 2022 GamesCrafters</h3>
            <?php renderFigure("The Fall 2022 GamesCrafters", "GamesCrafters2022Fa.jpg", "GamesCrafters2022FaCrazy.png") ?>
            <p>
                <?php renderNames("Back Row", "Pranav Sukumar, Jingfan 'Harry' Xia , Siddharth Ganapathy, Xiongsong Zhang, Kehan Chen") ?><br>
                <?php renderNames("Middle Row", "Jatearoon 'Keene' Boondicharern, Arihant Choudhary, Cameron Cheung, Nathaniel Haynam, Robert Shi") ?><br>
                <?php renderNames("First Row", "Victoria Phelps, Mia Campdera-Pulido, Dan Garcia, Linh Tran") ?><br>
                <?php renderNames("Not Pictured", "Kaelyn Huang, Harnoor Dhillon") ?>
            </p>
            <hr>
            <h3>The Fall 2019 GamesCrafters</h3>
            <?php renderFigure("The Fall 2019 GamesCrafters", "GamesCrafters2019Fa.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Michael Chou, Tommy Joseph, Qiuran Yin, Andy Sheu, Jordan Knox, Spencer McCall, Jordan Bell, Austin Chang, Seth Lu, Kunal Kak") ?><br>
                <?php renderNames("Third Row", "Karan Shah, Danyal Shahroz, Shein Lin Phyo, Jose Alfaro, Lawrence Zhao, Anthony Ling") ?><br>
                <?php renderNames("Second Row", "Blair Gao, Niloofar Izadian, Yiwen Chen, Grace Kull") ?><br>
                <?php renderNames("First Row", "Linh Tran, Zoe Plaxco, Sophie Yoo, Hayden Koerner, Stella Wan") ?><br>
                <?php renderNames("Not Pictured", "Dan Garcia, Brian Fu, Kendall Choy, Bryant Bettencourt, Vahram Khachikyan, Calvin Wong, Chuxiong Quan, Frank Cuoco, Lucas Huang, Qiuran Hu, Robert Meyer") ?>
            </p>
            <hr>
            <h3>The Spring 2019 GamesCrafters</h3>
            <?php renderFigure("The Spring 2019 GamesCrafters", "GamesCrafters2019Sp.jpg", "GamesCrafters2019SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Noah Kingdon, Matthew Pearson, Taejong Kim, Seth Lu, Danny Geitheim") ?><br>
                <?php renderNames("Second Row", "Zoe Plaxco, Gloria Zhao, Elaine Jiyoun Kim, Flora Dong, Tram Tran") ?><br>
                <?php renderNames("First Row", "Kendall Choy, Spencer McCall, Karan Shah, Ajay Kosuri, Eric Ying") ?><br>
                <?php renderNames("Front", "Dan Garcia") ?><br>
                <?php renderNames("Not Pictured", "Kawin Swaddiwudhipong, Fang Shuo Deng, Michelle Brier, Brian Fu, Kendall Choy") ?>
            </p>
            <hr>
            <h3>The Fall 2018 GamesCrafters</h3>
            <?php renderFigure("The Fall 2018 GamesCrafters", "GamesCrafters2018Fa.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Junce Wang, Isaac Merritt, Bryant Bettencourt, Seth Lu, Brian Fu") ?><br>
                <?php renderNames("Second Row", "Alex Ho, Sibo Chen, Abhijay Bhatnagar, Kendall Choy, Xizi Ni") ?><br>
                <?php renderNames("Front Row", "Sean Kim, Kaela Seiersen, Dan Garcia, Khadijah Flowers, Gustavo De Leon") ?>
            </p>
            <hr>
            <h3>The Spring 2018 GamesCrafters</h3>
            <?php renderFigure("The Spring 2018 GamesCrafters", "GamesCrafters2018Sp.jpg", "GamesCrafters2018SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Bryant Bettencourt, Isaac Merritt, Kevin Colkitt, Seth Lu") ?><br>
                <?php renderNames("Third Row", "Alex Ho, Kellyann Ye, Alyssa Sugarman, Niki Zarkub, Kaela Seiersen") ?><br>
                <?php renderNames("Second Row", "Dan Garcia") ?><br>
                <?php renderNames("Front Row", "Brian Fu, Sofie Herbeck, Matthew Pearson") ?><br>
                <?php renderNames("Not Pictured", "Flora Dong") ?>
            </p>
            <hr>
            <h3>The Fall 2014 GamesCrafters</h3>
            <?php renderFigure("The Fall 2014 GamesCrafters", "GamesCrafters2014Fa.jpg", "GamesCrafters2014FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Shuai Shao, Mincheol Sung, Byung Choi, Ryan Li, Dhruv Relwani") ?><br>
                <?php renderNames("Front Row", "Kyle Zentner") ?><br>
                <?php renderNames("Not Pictured", "Junwei Yu") ?>
            </p>
            <hr>
            <h3>The Fall 2013 GamesCrafters</h3>
            <?php renderFigure("The Fall 2013 GamesCrafters", "GamesCrafters2013Fa.jpg", "GamesCrafters2013FaCrazy.jpg") ?>
            <hr>
            <h3>The Fall 2012 GamesCrafters</h3>
            <?php renderFigure("The Fall 2012 GamesCrafters", "GamesCrafters2012Fa.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Paul Yeem, Andrew Chen, Zachary Bush, Kyle Zentner, Benjamin Liu") ?><br>
                <?php renderNames("Third Row", "Gabby Ho, Ali Kayes, Ben Izatt, Kyle Lian") ?><br>
                <?php renderNames("Second Row", "Michael Wu, Stephen Chen, Stephen Pham, Jason Duval, Steven Nguyen") ?><br>
                <?php renderNames("Front Row", "Helen Rao, Cassie Seo, Madeeha Ghori, Lily Lin") ?><br>
                <?php renderNames("Not Pictured", "Allison Hall") ?>
            </p>
            <hr>
            <h3>The Spring 2012 GamesCrafters</h3>
            <?php renderFigure("The Spring 2012 GamesCrafters", "GamesCrafters2012Sp.jpg", "GamesCrafters2012SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Kevin Jorgensen, David Huang, Kyle Lian, Lewin Gan, Bryan Chu, William Shen, Robert Marks, Zachary Bush") ?><br>
                <?php renderNames("Third Row", "Avi Press, Christopher Jernigan, Jack Long, Bing Chong Lim, Sung Roa Yoon, Ali Kayes, Brandon Luong") ?><br>
                <?php renderNames("Second Row", "Andrew Osheroff, Joe Wang, Arash (Sean) Mozarmi, Xueqiao (George) Deng, Eric Dohyeong Kim, Ian Ornstein") ?><br>
                <?php renderNames("Front Row", "Kenny Shiu, Eugenia Lee, Allison Hall, Juan Gonzalez, Kevin Shih") ?><br>
                <?php renderNames("Not pictured", "David Spies") ?>
            </p>
            <hr>
            <h3>The Fall 2010 GamesCrafters</h3>
            <?php renderFigure("The Fall 2010 GamesCrafters", "GamesCrafters2010Fa.jpg", "GamesCrafters2010FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Kevin Jorgensen, Pin (Dan) Xu, Glenn Sugden, Kyle Lian, Albert Wang, Ian Vonseggern") ?><br>
                <?php renderNames("Fourth Row", "Ihor Proskurin, Patrick Horn, Kevin Shih, Eric Liang, Peter Cheng, Jimmy Wu, James Ide") ?><br>
                <?php renderNames("Third Row", "Huan Do, Brent Batas, Derek Lau, Paul Ruan, Kevin Wang") ?><br>
                <?php renderNames("Second Row", "Brian Lin, Lakshminarasimhan Muralidharan, Mark Lu, Andrew Lau, Anirudh Todi") ?><br>
                <?php renderNames("Front Row", "Caroline Modic, Linsey Hansen, Chih Hu, Nancy Wang, Gayane Vardoyan, Rajeshwari Srikantan") ?><br>
                <?php renderNames("Not pictured", "Tarush Bali, Raghav Chandra, Daniel Corral, Sam Kazemkhani, Xingyan (Steven) Liu,
                Sharmistha Pal, Rohit Poddar, Omer Sagy, David Spies, Andrew Zhai") ?>
            </p>
            <hr>
            <h3>The Spring 2009 GamesCrafters</h3>
            <?php renderFigure("The Spring 2019 GamesCrafters", "GamesCrafters2009Sp.jpg", "GamesCrafters2009SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Kevin Jorgensen, Jeremy Fleischman, James Ide, Scotty Hoag, David Jiang, Camilo King, Raymond von Mizener") ?><br>
                <?php renderNames("Third Row", "Edward Lin, Richard Shin, Patrick Horn, Ofer Sadgat, David Spies, Wesley Hart") ?><br>
                <?php renderNames("Second Row", "Aleo Mok, Philip Ly, Edison Tung, Royce Cheng-Yue, Alex Degtiar, Steven Schlansker") ?><br>
                <?php renderNames("Front Row", "Megan Bernstein, Doris Hung, Gayane Vardoyan, Danica Shei, Daisy Zhou") ?><br>
                <?php renderNames("Not pictured", "Alan Choi, Zelam Ngo, Alex Trofimov, In Woo \"Lucas\" Cheon") ?>
            </p>
            <hr>
            <h3>The Fall 2008 GamesCrafters</h3>
            <?php renderFigure("The Fall 2008 GamesCrafters", "GamesCrafters2008Fa.jpg", "GamesCrafters2008FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Patrick Horn, Wesley Hart, James Ide, Steven Liu, Christian Pedersen, Ray Peterson") ?><br>
                <?php renderNames("Middle Row", "Ashish Chaudhari, Daniel Wei, Kevin Liu, Karthik Jagadeesh, Terrence Zhao") ?><br>
                <?php renderNames("Front Row", "Steven Schlansker, Jin-su Oh, Sarah Brodsky, Dan Garcia, Megan Bernstein, Jeremy Fleischman, Alan Wong") ?>
            </p>
            <hr>
            <h3>The Spring 2008 GamesCrafters</h3>
            <?php renderFigure("The Spring 2008 GamesCrafters", "GamesCrafters2008Sp.jpg", "GamesCrafters2008SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Niels Joubert, James Liao, Dounan Shi, Alan Wong, Austin McGee, Yiding Jia") ?><br>
                <?php renderNames("Fourth Row", "Steven Liu, Willie Wong, Ethan Rahn, Roger Tu, William Li") ?><br>
                <?php renderNames("Third Row", "Mike Dreibelbis, Chayut Thanapirom, Andrew Toulouse, Jeffrey Bair, Anthony Chen, John Ng") ?><br>
                <?php renderNames("Second Row", "Alan Roytman, Kevin Liu, Jerry Hong") ?><br>
                <?php renderNames("Front Row", "Omar Akkawi, York Wu, James Ide") ?>
            </p>
            <hr>
            <h3>The Fall 2007 GamesCrafters</h3>
            <?php renderFigure("The Fall 2007 GamesCrafters", "GamesCrafters2007Fa.jpg", "GamesCrafters2007FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Albert Shau, William Li, James Ide, Keaton Mowery, David Poll") ?><br>
                <?php renderNames("Fourth Row", "Daniel Wei, Yiding Jia, Michael So, Ofer Sadgat, Filip Furmanek") ?><br>
                <?php renderNames("Middle", "Taejun Lee, Anthony Chen, Alan Young, Alan Roytman, Louis Chan") ?><br>
                <?php renderNames("Second Row", "Omar Akkawi, Kevin Liu, Dounan Shi, David Chan, Moonway Lin") ?><br>
                <?php renderNames("Front Row", "Patricia Fong, Brian Taylor, Henry Su") ?><br>
                <?php renderNames("Missing", "Teng Lim, Jerry Hong, Valerie Ishida, Hong Nguyen") ?>
            </p>
            <hr>
            <h3>The Spring 2007 GamesCrafters</h3>
            <?php renderFigure("The Spring 2007 GamesCrafters", "GamesCrafters2007Sp.jpg", "GamesCrafters2007SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Casey Rodarmor, Ben Sussman, Michael Greenbaum, Alex Choy, Hsiu-fan Wang, David Poll") ?><br>
                <?php renderNames("Fourth Row", "Jon Whiteaker, Brian Nguyen, David Cerri, Michael Udaltsov, Sean Carr, Filip Furmanek, Ramesh Sridharan") ?><br>
                <?php renderNames("Middle", "Robert Liao, Nishant Thukral, Ann Chen, Andrew Ma, Diana Fang, Ilya Landa, Jerry Hong, David Chan, Manu Srivastava, Svetoslav Kolev, Ofer Sadgat, Matt Jacobsen, Brian Zimmer") ?><br>
                <?php renderNames("Second Row", "Eudean Sun, Yanpei Chen, Larry Ly, Jun Kang, Daniel Wei, Kevin Liu, Alan Roytman, Keaton Mowery") ?><br>
                <?php renderNames("Front Row", "Albert Chae, Deepa Mahajan, Yuly Tenorio, Omar Akkawi, Max Delgadillo, Simon Tao") ?><br>
                <?php renderNames("Person Standing in Front", "Patricia Fong") ?><br>
                <?php renderNames("Missing", "Phillip Persley, Albert Shau, Zach Wasserman") ?>
            </p>
            <hr>
            <h3>The Fall 2006 GamesCrafters</h3>
            <?php renderFigure("The Fall 2006 GamesCrafters", "GamesCrafters2006Fa.jpg", "GamesCrafters2006FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Eudean Sun, Sean Carr, Joseph Firmansyah") ?><br>
                <?php renderNames("Fourth Row, (Standing)", "Max Delgadillo, Matt Johnson, Alan Wu, Ofer Sadgat, Jacob Andreas, Keaten Mowery ") ?><br>
                <?php renderNames("Third Row, (Standing)", "Kwei-you (Simon) Tao, David Chan, Jerry Hong, Kevin Liu, David Eidan Poll, Alexander Zorbach, Shah Bawany, Ramesh Sridharan, Zach Wasserman") ?><br>
                <?php renderNames("Second Row, (Sitting)", "Daniel Wei, Faculty Advisor Dan Garcia, Patricia Fong, Diana Fang, Ann Chen, Alvin Chyan, Alan Roytman") ?><br>
                <?php renderNames("Front Row, (Squatting)", "Albert Shau, Jun Kang Chin, David Wu, Brian Zimmer, Yanpei Chen, Tim Chen") ?>
            </p>
            <hr>
            <h3>The Spring 2006 GamesCrafters</h3>
            <?php renderFigure("The Spring 2006 GamesCrafters", "GamesCrafters2006Sp.jpg", "GamesCrafters2006SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Michael Hamada, Filip Furmanek, Matt Jacobsen") ?><br/>
                <?php renderNames("Fourth Row, (Standing)", "Victor Perez, Max Delgadillo, Eric Siroker, David Eitan Poll, Keaton Mowery") ?><br>
                <?php renderNames("Third Row, (Standing)", "David Chan, Alex Choy, Amit Matani, Joey Corless, Adam Abed, Aaron Levitan, Sean Carr, Michael Greenbaum, Evan Huang, Mario Tanev, Yanpei Chen, Albert Chae, Ramesh Sridharan") ?><br>
                <?php renderNames("Second Row, (Sitting)", "Deepa Mahajan, Amy Hsueh, Faculty Advisor Dan Garcia, Cynthia Okita, Vik Singh, Alan Roytman") ?><br>
                <?php renderNames("Front Row, (Squatting)", "Keny Fan, Johnny Tran, Matt Johnson, Alan Wu, Chih-Yun (Steve) Wu, Eudean Sun, Kwei-you (Simon) Tao") ?><br>
                <?php renderNames("Missing", "Ken Elkabany, Diana Fang, Damian Hites, Elmer Lee, John Lo, Kyler Murlas, Aaron Staley, Alex Wallish, Alex Wasserman, Dan Yan, Brian Zimmer") ?>
            </p>
            <hr>
            <h3>The Fall 2005 GamesCrafters</h3>
            <?php renderFigure("The Fall 2005 GamesCrafters", "GamesCrafters2005Fa.jpg", "GamesCrafters2005FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Fourth Row", "Joey Corless, Victor Perez, Jason Wu, Robert Liao, Alan Roytman, Mario Tanev, Brian Zimmer, Keaton Mowery, Elmer Lee") ?><br>
                <?php renderNames("Third Row", "Matt Mieckowski, Christian Alarcon, Sylvain La, Jack Hsu, Sean Carr, David Chen, Diana Fang, Evan Huang, John Lo") ?><br>
                <?php renderNames("Second Row", "Eudean Sun, Amy Hsueh, Cynthia Okita, Yuliya Sarkisyan, Cindy Song, Ann Chen, Yanpei Chen") ?><br>
                <?php renderNames("Front Row", "Kyler Murlas, Zach Wasserman, Suthee Un, Dan Yan, Alex Choy") ?><br>
                <?php renderNames("Missing", "Dr. Dan Garcia, Eric Siroker, Peter Yu. Filip Furmanke") ?>
            </p>
            <hr>
            <h3>The Spring 2005 GamesCrafters</h3>
            <?php renderFigure("The Spring 2005 GamesCrafters", "GamesCrafters2005Sp.jpg", "GamesCrafters2005SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Fourth Row", "Robert Liao, Guy Boo, Dan Yan, Sean Carr, Yanpei Chen, Ming (Evan) Huang") ?><br>
                <?php renderNames("Third Row", "Jeff Chiang, Jeff Chou, Chris Willmore, Laurin Beckhusen, Joshua Kocher, Damian Hites") ?><br>
                <?php renderNames("Second Row", "John Lo, Yuliya Sarkisyan, Ann Chen, Diana Fang, Cynthia Okita, Nathan Spindel") ?><br>
                <?php renderNames("Front Row", "Matt Mieckowski, Mario Tanev, Dan Garcia, Elmer Lee, Ozan Demirlioglu") ?><br>
                <?php renderNames("Missing", "Greg Bonin, Amy Hsueh, Cindy Xue Song, Daniel Honegger, Eric Siroker, Scott Lindeneau") ?>
            </p>
            <hr>
            <h3>The Fall 2004 GamesCrafters</h3>
            <?php renderFigure("The Fall 2004 GamesCrafters", "GamesCrafters2004Fa.jpg", "GamesCrafters2004FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Fourth Row", "Peter Wu, Yonathan Randolph, Michel D’Sa, Sean Carr, Steven Kusalo, Greg Bonin, Jeff Chou, Edward Li, Nathan Spindel") ?><br>
                <?php renderNames("Third Row", "Robert Liao, Scott Lindeneau, John Jordan, Damian Hites, Alex Wallisch, Michael Mottman, Erik Siroker, Joe Jing ") ?><br>
                <?php renderNames("Second Row", "Elmer Lee, Emad Salman, Timmothy Palk, Dan Yan, Jeff Chiang, Yanpei Chen") ?><br>
                <?php renderNames("Front Row", "Josh Chang, Cynthia Okita, Dan Garcia, Diana Fang, Jonathan Tsai") ?>
            </p>
            <hr>
            <h3>The Spring 2004 GamesCrafters</h3>
            <?php renderFigure("The Spring 2004 GamesCrafters", "GamesCrafters2004Sp.jpg", "GamesCrafters2004SpCrazy.jpg") ?>
            <p>
                <?php renderNames("Sixth Row", "Jeffrey Chiang, Newton Le, Damian Hites, John (JJ) Jordan") ?><br>
                <?php renderNames("Fifth Row", "Elmer Lee, Reman Child, Michel D'Sa, Hobart Sze, Greg Bonin") ?><br>
                <?php renderNames("Fourth Row", "Neil Trotter,Eric Siroker, Scott Lindeneau,Michael Mottmann, Dan Garcia") ?><br>
                <?php renderNames("Third Row", "Erwin Vedar, Alice Chang, Cynthia Okita, Melinda Franco, Tanya Gordeeva") ?><br>
                <?php renderNames("Second Row", "Kevin Duncan, Nelson Bradley, Bryon Ross, Robert Liao, Michael Chen, Wei Tu") ?><br>
                <?php renderNames("Front Row", "Edward Li, Kevin Ip, Jonathan Tsai, Fun-Shing Sin, Rach Liu") ?><br>
                <?php renderNames("Missing", "Sean Carr, Alex Wallisch") ?>
            </p>
            <hr>
            <h3>The Fall 2003 GamesCrafters</h3>
            <?php renderFigure("The Fall 2003 GamesCrafters", "GamesCrafters2003Fa.jpg", "GamesCrafters2003FaCrazy.jpg") ?>
            <p>
                <?php renderNames("Third Row", "Jesse Phillips, Keith Ho, Rach Liu, Bryon Ross, Tse-Wen Wang, Nicholas Hwang, Elmer Lee") ?><br>
                <?php renderNames("Second Row", "Jeffrey Chiang, Scott Lindeneau, Dan Garcia, John Jordan, Damian Hites, Michel D’Sa, Jonothan Tsai") ?><br>
                <?php renderNames("Front Row", "Heather Kwong, Cassie Guy, Cynthia Okita, Eleen Chiang, Judy Chen, Jennifer Lee, Alice Chang") ?><br>
            </p>
            <hr>
            <h3>The Spring 2003 GamesCrafters</h3>
            <?php renderFigure("The Spring 2003 GamesCrafters", "GamesCrafters2003Sp.jpg") ?>
            <p>
                <?php renderNames("Fourth Row", "Peter Foo, Albert Cheng, Jeffrey Chiang, Dan Garcia, Brian Foo, Attila Gyulassy, Tse-Wen Wang, Bryon Ross, Spencer Ray") ?><br>
                <?php renderNames("Third Row", "Anh Thai, Eleen Chiang, Alice Chang, Judy Tuan, Jennifer Lee, Judy Chen, Cassie Guy") ?><br>
                <?php renderNames("Second Row", "Erwin Vedar, Rach Liu, Chris Hsu, Jesse Phillips, Ming Cheng, Miroslav Enev, Keith Ho") ?><br>
                <?php renderNames("Front Row", "Kyler Murlas, Zach Wasserman, Suthee Un, Dan Yan, Alex Choy") ?><br>
                <?php renderNames("Missing", "Peter Trethway, Sunil Ramesh, Jiong Shen, Alex Kozlowski, Farzad Eskafi") ?>
            </p>
            <hr>
            <h3>The Fall 2002 GamesCrafters</h3>
            <?php renderFigure("The Fall 2002 GamesCrafters", "GamesCrafters2002Fa.jpg") ?>
            <p>
                <?php renderNames("Third Row", "Chris Hsu, Ming Can Chang, Alice Chiang, Sandra Tang, Anh Thai, Erwin Vedar, Daniel Horn") ?><br>
                <?php renderNames("Second Row", "Brian Foo, Desmond Cheung, Albert Cheng, Vadim Gorin, Eric Miles, Shiva Bhattacharjee, Venu Kolavennu, Jeffrey Chiang, Dave Wong, Bryon Ross") ?><br>
                <?php renderNames("Front Row", "Alex Perelman, Sunil Ramesh, Dan Garcia, Peter Trethway, Attila Gyulassy") ?><br>
            </p>
            <hr>
            <h3>The Spring 2002 GamesCrafters</h3>
            <?php renderFigure("The Spring 2002 GamesCrafters", "GamesCrafters2002Sp.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Peter Tretheway, Erwin Vedar, Farzad Eskafi, Dave Le, Isaac Greenbride, Dan Garcia, James Chung, Alex Perelman, Atilla Gyulassy, Sunil Ramesh") ?><br>
                <?php renderNames("Front Row", "Thomas Yiu, Edwin Mach, Alex Kozlowski, Mike Savitsky, Kevin Ha, Babak Hamadini") ?><br>
                <?php renderNames("Missing", "Todd Segal, David Shultz, Greg Krimer, Chi Huynh, David Chen, Ling Xiao") ?>
            </p>
            <hr>
            <h3>The Fall 2001 GamesCrafters</h3>
            <?php renderFigure("The Fall 2001 GamesCrafters", "GamesCrafters2001Fa.jpg") ?>
            <p>
                <?php renderNames("Back Row", "Thomas Yiu, Isaac Greenbride, Dan Garcia, Farzad Eskafi, Chi Huynh, Erwin Vedar, Edwin Mach, Mike Savitsky, James Chung, Alex Kozlowski") ?><br>
                <?php renderNames("Carried", "Dave Le") ?><br>
                <?php renderNames("Missing", "Peter Tretheway, Todd Segal, David Shultz, Greg Krimer") ?>
            </p>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>