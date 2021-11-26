# Servicedesken ticketsystem

Softwaren bliver brugt af servicedesken til at lave tickets for indleverede opgaver.

Softwaren er efterhånden ved at være gammel og trænger til en kærlig hånd.

# Rettelser der ønskes udført
- [x] Der findes to mapper elev og admin, som indeholder meget af den samme kode.
- [x] Der er allerede taget højde for login rolle, den skal bruges direkte i koden og ikke som nu sende brugen i forskellige mapper.
- [ ] Tjek af databasen indholder den den rigtige information og de rigtige felter eller kan den optimeres.
- [x] Visning af id er taget væk - det gør det sværere at backtracke opgaver for eleverne.
- [x] Eleverne har ikke adgang til at se afsluttede sager. Det rettes så elev rollen kan se men ikke redigere i lukkede sager.
- [x] Der vises ikke kundenavn på siden: Lukkede sager
- [ ] Serveren er ved at være gammel, trænger til opdatering.
- [ ] Søge funktion som søger på beskrivelse, email og navn.
- [x] Der lavet noget til at sætte ønsket sortering. Funktionen laves færdig.
- [ ] Måske skulle man lave det Adaptive, så den også kan køre på elevernes mobil.

# Systemet som kører servicedesken
    cat /etc/*-release
    
    PRETTY_NAME="Debian GNU/Linux 9 (stretch)"
    NAME="Debian GNU/Linux"
    VERSION_ID="9"
    VERSION="9 (stretch)"
    ID=debian
    HOME_URL="https://www.debian.org/"
    SUPPORT_URL="https://www.debian.org/support"
    BUG_REPORT_URL="https://bugs.debian.org/"

eller man kan køre:
    lsb_release -a

    No LSB modules are available.
    Distributor ID: Debian
    Description:    Debian GNU/Linux 9.5 (stretch)
    Release:        9.5
    Codename:       stretch

man finder oplysninger om kernen:
    uname -mrs
    
    Linux 4.9.0-8-amd64 x86_64

=======
# servicedesken
>>>>>>> 93d8338ec08e7be30cf8014d867e14992d7e8637
