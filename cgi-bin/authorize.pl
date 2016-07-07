#!C:\Perl\bin\perl
# Fig. 25.17: fig25_17.pl
# Program to search a database for usernames and passwords.

use CGI qw( :standard );
use DBI;
use DBD::mysql;

$dtd = "<!DOCTYPE HTML>";

$username = param( "username" );
$password = param( "password" );

my $user = chomp($username);
my $passd = chomp($password);

my $database = "sccwp";
my $hostname = "localhost";
my $port = 3306;
my $user = "kenny";
my $pwd = "kc226975";
my $dsn = "DBI:mysql:database=$database;host=$hostname;port=$port";

# Connect to the database.
my $dbh = DBI->connect($dsn, $user, $pwd, {'RaiseError' => 1});


# now retrieve data from the table.
my $sth = $dbh->prepare("SELECT * FROM users WHERE userName = $user");
$sth->execute();
my $ref = $sth->fetchrow_hashref();
my $id = $ref->{'id'};
my $uname = $ref->{'userName'};
my $password = $ref->{'passWord'};
$sth->finish();

# Disconnect from the database.
$dbh->disconnect();

if($username eq $uname){
	if($passd eq $password){
		accessGranted();
	}else{
		wrongPassword();
	}
}else{
	wrongUsername();
}

##########################################################################################################################################################
#																	Sub Routines																		 #
##########################################################################################################################################################
sub accessGranted
{
   print( div( { style => "font-face: arial; color: blue; font-weight: bold" }, "Permission has been granted, $username.", br(), "Enjoy the site." ) );
   print( div( { style => "font-face: arial; color: blue; font-weight: bold" }, "<a href='allStudentScores.php'>Continue to website</a>" ) );
}

sub wrongPassword
{
   print( div( { style => "font-face: arial; color: red; font-weight: bold" }, "You entered an invalid password.", br(), "Access has been denied." ) );
}

sub wrongUsername
{
   print( div( { style => "font-face: arial; color: red; font-size: larger; font-weight: bold" }, "You entered an invalid username.", br(), $username, " is either not registered or not active." ) );
}
##########################################################################################################################################################
#																	End Sub Routines																	 #
##########################################################################################################################################################