# Servicedesken ticketsystem

Softwaren bliver brugt af servicedesken til at lave tickets for indleverede opgaver.

Softwaren er efterhånden ved at være gammel og trænger til en kærlig hånd.

# Rettelser der ønskes udført
* Der findes to mapper elev og admin, som indeholder meget af den samme kode.
* Der er allerede taget højde for login rolle, den skal bruges direkte i koden og ikke som nu sende brugen i forskellige mapper.
* Tjek af databasen indholder den den rigtige information og de rigtige felter eller kan den optimeres.
* Visning af id er taget væk - det gør det sværere at backtracke opgaver for eleverne.
* Eleverne har ikke adgang til at se afsluttede sager. Det rettes så elev rollen kan se men ikke redigere i lukkede sager.

# Systemet som kører servicedesken
    skp@SKP-DEB9-01:~$ cat /etc/*-release
    PRETTY_NAME="Debian GNU/Linux 9 (stretch)"
    NAME="Debian GNU/Linux"
    VERSION_ID="9"
    VERSION="9 (stretch)"
    ID=debian
    HOME_URL="https://www.debian.org/"
    SUPPORT_URL="https://www.debian.org/support"
    BUG_REPORT_URL="https://bugs.debian.org/"
