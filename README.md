# Sircon oppgave for læreplass

docker-compose app med mongodb, nginx, php backend

krav for prosjektet

1: Sett opp en WebSocket server i PHP og kjør den på din egen server/maskin/virtuell maskin.
2: Krev registrering og innlogging.
3: Lag en nettside med et HTML canvas element som ved trykk på en pixel/rute i canvas endrer fargen på pixelen/ruten til en farge som brukeren har valgt under bruker registrering, Ved hjelp av websocket skal canvas alltid være likt for alle brukere og alle endringer vises live til samtlige brukere.


Prosjektet er veldig lett å kjøre med docker-compose.
Bare 'docker-compose up' i terminal på en maskin med docker og docker-compose og vent en stund til docker images er bygget ved første oppstart.

Jeg tror det var tenkt at vi skulle sende farge og posisjonsdata over websocket. Men med jwt autentikasjon tenker jeg det blir bedre å starte med å pushe til database også si ifra med websocket broadcast. Dette fører også til at fargene kan være persistent, slik at fargene blir lastet inn fra database når en åpner websiden.

## Oopsies
Skulle ønske jeg startet dette prosjektet med å lese om ratchet websocket server. Da kunne jeg ha brukt annet system for APIen som python flask som jeg liker godt.

## SSL
Jeg har med diverse SSL og cerbot saker kommentert ut, men viser hvordan jeg brukte let's encrypt på live serveren min før jeg byttet til DNS acme challenge.

