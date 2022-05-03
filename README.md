# Servicedesk Ticket system

Softwaren bliver brugt af servicedesken til at lave tickets for indleverede opgaver. Der er mulighed for at indsætte brugere og holde styr over kundens kontakt oplysninger. 

Er skrevet i / benytter:
* PHP
* HTML
* CSS
* Bootstrap
* MySQL i form af MariaDB
* PHPMyAdmin

# Rettelser der ønskes udført
- [x] Der findes to mapper elev og admin, som indeholder meget af den samme kode.
- [x] Der er allerede taget højde for login rolle, den skal bruges direkte i koden og ikke som nu sende brugen i forskellige mapper.
- [x] Tjek af databasen indholder den den rigtige information og de rigtige felter eller kan den optimeres.
- [x] Visning af id er taget væk - det gør det sværere at backtracke opgaver for eleverne.
- [x] Eleverne har ikke adgang til at se afsluttede sager. Det rettes så elev rollen kan se men ikke redigere i lukkede sager.
- [x] Der vises ikke kundenavn på siden: Lukkede sager
- [x] Serveren er ved at være gammel, trænger til opdatering. Er opdateret først til DEB10 og dernæst til Debian 11 pr. 2-5-2022.
- [x] Søge funktion som søger på beskrivelse, email og navn.
- [x] Søge funktion skal vise seneste først.
- [x] Der lavet noget til at sætte ønsket sortering. Funktionen laves færdig.
- [ ] Måske skulle man lave det Adaptive, så den også kan køre på elevernes mobil.
- [x] Bootstrap opdateres til seneste 4.0.0.
- [x] Modtager findes ikke i databasen! fejl som stopper Opdater sagsiden.
- [x] Der mangler en funktion som håndterer når elever slettes fra systemet, eks. når de meldes ud af SKP. Hænger sammen med fejlen Modtager findes ikke i databasen!. Rettes til at gives beskeden: Tidligere elev.
- [x] Sidernes header skal have hvid tekst, så man kan læse det
- [ ] Tabellens hoved laves sort med tynd grøn border, som de andre grafiske elementer.
- [x] Sortering af tickets på siden Lukkede sager rettes til seneste først.
- [x] Rettelse af meget gamle cron jobs <- Slettet
- [x] Upload mappe bliver ikke brugt i koden <- Slettet

# Systemet som kører servicedesken
    cat /etc/*-release
    
    PRETTY_NAME="Debian GNU/Linux 11 (bullseye)"
    NAME="Debian GNU/Linux"
    VERSION_ID="11"
    VERSION="11 (bullseye)"
    VERSION_CODENAME=bullseye
    ID=debian
    HOME_URL="https://www.debian.org/"
    SUPPORT_URL="https://www.debian.org/support"
    BUG_REPORT_URL="https://bugs.debian.org/"

eller man kan køre:
    lsb_release -a

    No LSB modules are available.
    Distributor ID: Debian
    Description:    Debian GNU/Linux 11 (bullseye)
    Release:        11
    Codename:       bullseye

man finder oplysninger om kernen:
    uname -mrs
    
    Linux 5.10.0-13-amd64 x86_64
<hr />
