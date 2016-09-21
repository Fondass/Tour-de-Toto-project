<?php

class FonDatabase
{
    public function __construct()
    {
        if (PDODAO::connect() == true)
        {

        }
        else
        {
            die("NO DATABASE CONNECTION");
        }
    }

//================================================
//           get password permission on userid
//================================================
/*
 * Looks up the password that is coupled with an
 * entered useridprovided by a user. username
 * need to be a valid entry in the databse for 
 * this function to return something. 
*/    
//================================================
  
    public function getPasswordPermissionOnUserid($userid)
    {
        $sql = 'SELECT password, Permission FROM users WHERE id="'.$userid.'"';
        $statement = PDODAO::prepareStatement($sql);
        $result = PDODAO::getArray($statement);

        return $result; // returns the valid password 
    }
    
//================================================
//                  get salt
//================================================
/*
 * looks up the added password salt in the database
 * (which is a column in the users table).
 * 
 * salt refers to a password hashtag defined in script.
 */   
//================================================  
    public function getSalt($id)
    {
       $sql = 'SELECT salt FROM users WHERE id = "'.$id.'"';
       $result = PDODAO::getDataArray($sql);
       //echo $result['salt'];
       return $result['salt'];
    }
    
//================================================
//              save Rider Into Db
//================================================
/*
 * Saves athletes into the database. Accessible by
 * admin from admin-page.
 */   
//================================================   
    
    public function saveRiderIntoDb($rider, $team)
    {
        $sql = 'INSERT INTO athletes(Name, Team_ID, Active) 
                VALUES ("'.$rider.'","'.$team.'", "1")';
        PDODAO::doInsertQuery($sql);
    }
    
//================================================
//              save Team Into Db
//================================================
/*
 * Saves teams into the database. Accessible by
 * admin from admin-page.
 */   
//================================================   
    
    
    public function saveTeamIntoDb($team, $country)
    {
        $sql = 'INSERT INTO teams (Team, Country_ID)
                VALUES ("'.$team.'", "'.$country.'")';
        PDODAO::doInsertQuery($sql);
    }
    
    
//================================================
//              save Country Into Db
//================================================
/*
 * Saves countries into the database. Accessible by
 * admin from admin-page.
 */   
//================================================       
    
    public function saveCountryIntoDb($country)
    {
        
        $sql = 'INSERT INTO countries (Country)
                VALUES ("'.$country.'")';
        PDODAO::doInsertQuery($sql);
    }
    
//================================================
//              get Countries From Database
//================================================
/*
 * Takes countries from the database
 */   
//================================================ 
    
    public function getCountriesFromDatabase()
    {
        $sql = 'SELECT id, Country
                FROM countries';
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//              get Teams From Database
//================================================
/*
 * Gets teams from the database
 */   
//================================================ 
    
    public function getTeamsFromDatabase()
    {
        $sql = 'SELECT id, Team
                FROM teams';
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//              get Athlete Information
//================================================
/*
 * Get's information about the athlete 
 * (which team and country they belong to)
 */   
//================================================ 
    
    public function getAthleteInformation($athlete)
    {
        $sql = 'SELECT 
                t.Team AS team,
                c.Country as country
                FROM
                countries c,
                teams t,
                athletes r
                WHERE
                r.Team_ID=t.id AND
                t.Country_ID=c.id AND
                r.id ='.$athlete.'
                ';
        $result = PDODAO::getDataArray($sql);
        return $result;
    }
    
//================================================
//            get Riders and Id
//================================================
/*
 * Get's riders and their id's
 */   
//================================================ 
    
    public function getRidersAndId()
    {
        $sql = 'SELECT 
                Name as rider,
                id as riderid
                FROM 
                athletes r';
        
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//            save Rider Selection
//================================================
/*
 * Saves the riderlist 
 * (25 riders per player per competition) into the database
 */   
//================================================ 
    
    public function saveRiderSelection($userid, $riderlist, $compid)
    {
        $sql = 'INSERT INTO user_athletes (Users_ID, Athletes_ID, Competition_ID, Rank)
            VALUES ';

        for ($i = 1; $i < 25; $i++)
        {
            $sql .= '('.$userid.', '.$riderlist[$i].', '.$compid.', '.$i.'),';
        }
        
        $sql .= '('.$userid.', '.$riderlist[25].', '.$compid.', 25)';

        PDODAO::doInsertQuery($sql);
    }
     
//================================================
//              get User Permission
//================================================
/*
 * Get's the permission from the user (user or admin)
 */   
//================================================ 
        
    public function getUserPermission()
    {
        $userid = $_SESSION["userid"];

        if (isset($userid) && $userid !== "")
        {
            $sql = 'SELECT permission FROM users WHERE id="'.$userid.'"';
            $result = PDODAO::getDataArray($sql);

            return $result['permission'];
        }
    }
    
//================================================
//                 save new user
//================================================
/*
 * saves the entries of a new user into the database.
 * 
 * salt refers to a password hashtag defined in script.
 */   
//================================================        
                     
    public function saveNewUser($newuser, $newpass, $salt, $email)
    {
        $sql = 'INSERT INTO users(Permission, Name, Password, E_Mail, salt) 
                VALUES ("1","'.$newuser.'","'.$newpass.'","'.$email.'","'.$salt.'")';
        return PDODAO::doInsertQuery($sql);
    }
    
//================================================
//              save Competition Entry
//================================================
/*
 * Saves that a user plays in a competition
 */   
//================================================   
    
    public function saveCompetionEntry($compid, $userid)
    {
        $sql = 'INSERT INTO competition_users(Competition_ID, Users_ID, riders_entered)
                VALUES ("'.$compid.'", "'.$userid.'", "1")';
        PDODAO::doInsertQuery($sql);
    }
    
//================================================
//                 get active User ID
//================================================
/*
 * Get's the ID of the active user
 */   
//================================================  
    
    public function getActiveUserID($username)
    {
        $sql = 'SELECT id FROM users
            WHERE Name="'.$username.'"';
        $result = PDODAO::getDataArray($sql);
        return $result[0];                
    }
    
//================================================
//                 User Has Entered Riders
//================================================
/*
 * Checks if the user has already entered a competition
 */   
//================================================  
    
    public function userHasEnteredRiders($userid, $compid)
    {
        $sql = 'SELECT riders_entered FROM competition_users
            WHERE Users_ID ="'.$userid.'" AND Competition_ID ="'.$compid.'"';
        $result = PDODAO::getDataArray($sql);
        return $result[0];
    }
    
//================================================
//              save new competition
//================================================
/*
 * Saves a new competition into the database
 */   
//================================================  
    
    public function saveNewCompetition($compname, $roundnum, $rounddate)
    {
        PDODAO::beginTransaction();
        
        $sql = 'INSERT INTO competition (Name)
                VALUES ("'.$compname.'")';
        PDODAO::doInsertQuery($sql);
        
        $qry = 'SELECT id FROM competition WHERE Name="'.$compname.'"';
        $compid = PDODAO::getDataArray($qry);


        $sql2 = 'INSERT INTO round (Round, Date, Competition_ID)
                 VALUES';
        
        for($i = 1; $i < $roundnum+1; $i++)
        {
            $sql2 .= '("'.$i.'", "'.$rounddate[$i].'", "'.$compid[0].'"),';
        }
        
        $sql2 = substr($sql2, 0, -1);

        PDODAO::doInsertQuery($sql2);

        PDODAO::commit();

    }
    
//================================================
//             get Active Competitions
//================================================
/*
 * Get's all the competitions
 */   
//================================================
    
    public function getActiveCompetitions()
    {
        $sql = 'SELECT Name, id FROM competition';
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//             get Active Competitions
//================================================
/*
 * Get's all the competitions
 */   
//================================================
    
    public function getRunningCompetitions()
    {
        $sql = 'SELECT Name, id FROM competition WHERE active=1';
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
    
    
    
//================================================
//             get Participated Competitions
//================================================
/*
 * Get's all the competitions
 */   
//================================================
    
    public function getParticipatedCompetitions($user)
    {
        $sql = 'SELECT c.Name, c.id 
                FROM competition c, competition_users o, users u 
                WHERE
                o.Competition_ID=c.id AND
                o.Users_ID=u.id AND
                u.id = '.$user.'';
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//             get Round on COmpetition ID
//================================================
/*
 * Get's the rounds and round information on
 * the competition ID
 */   
//================================================
    
    public function getRoundOnCompetitionId($id)
    {
        $sql = 'SELECT id, Round, Date FROM round WHERE Competition_ID="'.$id.'"';
        return PDODAO::getDataArrays($sql);
    }
    
//================================================
//             Save Etape Conclusion
//================================================
/*
 * Saves the ending of a etape in the database
 */   
//================================================
    
    public function saveEtapeConclusion($round, $winners)
    {
        $sql = 'INSERT INTO round_position 
            (Athletes_ID, Round_ID, Position, Points, active) VALUES ';
        
        foreach($winners as $value)
        {
            $sql .= '("'.$value[0].'", "'.$round.'", "'.$value[1].'", "'.$value[2].'", "'.$value[3].'"),';
        }
        
        $sql = substr($sql, 0, -1);
        
        PDODAO::doInsertQuery($sql);
    }
    
//================================================
//                  get riders top 10
//================================================
/*
 * Get's the top 10 of riders on competition
 */   
//================================================  
    
    public function getRidersTop10($competition)
    {
        $sql ='SELECT
            a.Name AS athletes,
            SUM(p.Points) as points
            FROM
            athletes a,
            round_position p,
            round r,
            competition c
            WHERE
            p.Athletes_ID=a.id AND
            p.Round_ID=r.id AND
            r.Competition_ID=c.id AND
            c.id = '.$competition.'
            GROUP BY
            a.Name
            ORDER BY
            points DESC,
            a.name
            LIMIT 10';

        $result = PDODAO::getDataArrays($sql);

        return $result;
    }
    
//================================================
//                  get teams top 5
//================================================
/*
 * Get's the top 5 teams on competition
 */   
//================================================  
    
    public function getTeamstop5($competition)
    {
        $sql = 'SELECT
              t.Team AS teams,
              SUM(p.points) as points
              FROM
              athletes a,
              round_position p,
              round r,
              competition c,
              teams t
              WHERE
              p.Athletes_ID=a.id AND
              p.Round_ID=r.id AND
              r.Competition_ID=c.id AND
              a.Team_ID=t.id AND
              c.id = '.$competition.'
              GROUP BY
              t.Team
              ORDER BY
              points DESC,
              t.Team
              LIMIT 5';
        
        $result = PDODAO::getDataArrays($sql);
        
        return $result;
    }
    

//================================================
//                  get countries top 3
//================================================
/*
 * gets the top 3 countries on competition
 */   
//================================================ 
    
    public function getCountriestop3($competition)
    {
        $sql = 'SELECT
              l.Country AS countries,
              SUM(p.points) as points
              FROM
              athletes a,
              round_position p,
              round r,
              competition c,
              teams t,
              countries l
              WHERE
              p.Athletes_ID=a.id AND
              p.Round_ID=r.id AND
              r.Competition_ID=c.id AND
              a.Team_ID=t.id AND
              t.Country_ID=l.id AND
              c.id = '.$competition.'
              GROUP BY
              l.Country
              ORDER BY
              points DESC,
              l.Country
              LIMIT 3';
        
        $result = PDODAO::getDataArrays($sql);
        
        return $result;
    }
    
//================================================
//    get player score data on competition
//================================================
/*
 * returns a list of usernames with attached rider id's and 
 * their rank in the users rider list. 
 * 
 *  [user_name, rider_id, rank]
 * 
 * note: multiple users are returned.
 */   
//================================================ 
    
    public function getPlayerscoreDataOnCompetition($competition)
    {
        $sql = 'SELECT
              u.Name as name,
              s.Athletes_ID as rider,
              s.Rank as rank
              FROM
              users u,
              user_athletes s
              WHERE
              s.Users_ID=u.id AND
              s.Competition_ID= '.$competition.'
              ORDER BY
              name,
              rank';
        
        return PDODAO::getDataArrays($sql);       
    }
    
//================================================
//      get rider score data on competition
//================================================
/*
 * returns a list of riders that attained a top 10
 * position in al rounds in a competition.
 * 
 *  [Round_id, Rider, position, points, active]
 */   
//================================================
    
    public function getRiderscoreDataOnCompetition($competition)
    {
        $sql = 'SELECT
              p.Round_ID as round,
              p.Athletes_ID as rider,
              p.Position as position,
              p.Points as points,
              p.Active as active
              FROM
              round_position p,
              round r
              WHERE
              p.Round_ID=r.id AND
              r.Competition_ID= '.$competition.'
              ORDER BY
              round,
              position';
        
        return PDODAO::getDataArrays($sql);
    }
    
//================================================
//            get player rider list
//================================================
/*
 * returns a list of rider id's and 
 * their rank in the users rider list on a competition
 * off only the logged in player  
 * 
 *  [user_name(1 user get's returned multiple times), rider_id, rank]
 */   
//================================================
    
    public function getPlayerRiderList($competition, $user)
    {
        $sql = 'SELECT
              u.Name as name,
              s.Athletes_ID as rider,
              s.Rank as rank
              FROM
              users u,
              user_athletes s
              WHERE
              s.Users_ID=u.id AND
              s.Competition_ID= '.$competition.' AND
              u.id = "'.$user.'"
              ORDER BY
              name,
              rank';
        
        return PDODAO::getDataArrays($sql); 
    }
    
//================================================
//            get latest etape winners
//================================================
/*
 * returns a list of riders in the latest etape
 * 
 * [rider name, position, points] Ordered from 1st to last.
 */   
//================================================
    
    public function getLatestEtapeWinners($competition)
    {
        $sql = 'SELECT
              a.Name as rider,
              p.Position as position,
              p.Points as points
              FROM
              round_position p,
              round r,
              athletes a
              WHERE
              p.Round_ID=r.id AND
              r.Competition_ID= '.$competition.' AND
              p.Athletes_ID=a.id AND
              p.Round_ID = 
              
              (SELECT p.Round_ID FROM round_position p, round r 
              WHERE r.Competition_ID='.$competition.' AND p.Round_ID=r.id 
              ORDER BY p.Round_ID DESC LIMIT 1)
              
              ORDER BY
              points DESC';
        
        return PDODAO::getDataArrays($sql);
    }
    
//================================================
//         get latest etape winners id
//================================================
/*
 * returns a list of riders that have finished 
 * (or have been disqualified) in a points position
 * of the latest etape in a competition.
 */   
//================================================
    
    public function getLatestEtapeWinnersID($competition)
    {
        $sql = 'SELECT
              p.Round_ID as round,
              p.Athletes_ID as rider,
              p.Position as position,
              p.Points as points,
              p.Active as active
              FROM
              round_position p,
              round r
              WHERE
              p.Round_ID=r.id AND
              r.Competition_ID= '.$competition.' AND
              p.Round_ID = 
              
              (SELECT p.Round_ID FROM round_position p, round r 
              WHERE r.Competition_ID='.$competition.' AND p.Round_ID=r.id 
              ORDER BY p.Round_ID DESC LIMIT 1)
              
              ORDER BY
              points DESC';
        
        return PDODAO::getDataArrays($sql);
    }
    
//================================================
//             get latest etape date
//================================================
/*
 * returns the date of the latest etape ridden
 * in a competition.
 */   
//================================================
    
    public function getLatestEtapeDate($competition)
    {
        $sql = 'SELECT
              r.Date as date
              FROM
              round r
              WHERE
              r.Competition_ID= '.$competition.' AND
              r.id = 
              
              (SELECT p.Round_ID FROM round_position p, round r 
              WHERE r.Competition_ID='.$competition.' AND p.Round_ID=r.id 
              ORDER BY p.Round_ID DESC LIMIT 1)';
        
        return PDODAO::getDataArray($sql)[0];
    }
    
//================================================
//       get inactive riders on competition
//================================================
/*
 * returns an array of riders that are no longer
 * active in a competition
 */   
//================================================
    
    public function getInactiveRidersOnCompetition($competition)
    {
        $sql = 'SELECT
              p.Athletes_ID as rider,
              p.Active as active
              FROM
              round_position p,
              round r
              WHERE
              p.Round_ID=r.id AND
              r.Competition_ID= '.$competition.' AND
              p.Active = 0';
        
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
//================================================
//           get finnished etape round
//================================================
/*
 * returns and array of etapes that have been
 * filled in as concluded by the admin.
 */   
//================================================
    
    public function getFinishedEtapeRound($competition)
    {
        $sql = 'SELECT
              DISTINCT r.Round as round
              FROM
              round r,
              round_position p
              WHERE
              r.Competition_ID= '.$competition.' AND
              p.round_ID=r.id';
        
        return PDODAO::getDataArrays($sql);
    }
    
//================================================
//   get inactive riders on competition etape
//================================================
/*
 * returns an array of riders that are no longer
 * active in a competition
 */   
//================================================
    
    public function getInactiveRidersOnCompetitionEtape($competition, $etape)
    {
        $sql = 'SELECT
              p.Athletes_ID as rider,
              p.Active as active
              FROM
              round_position p,
              round r
              WHERE
              p.Round_ID=r.id AND
              r.Competition_ID= '.$competition.' AND
              p.Active = 0 AND
              p.Round_id < '.$etape.'';
        
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
    public function saveCompletedCompetition($competition)
    {
        $sql = 'UPDATE competition
                SET active=0
                WHERE id='.$competition.'';
        
        return PDODAO::doUpdateQuery($sql);
    }
}