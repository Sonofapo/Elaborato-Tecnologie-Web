# UniBonsai

Questo repository contiene il progetto d'esame per Tecnologie Web creato da Alex Giamperoli e Antonio Emanuele Pepe durante l'anno accademico 2021/2022

## Descrizione

Il progetto in questione vuole offrire un sito web per la gestione e compravendita di prodotti, nello specifico bonsai di vario genere.

## Utilizzo

### Compratore

Il sito è utilizzabile da qualsiasi utente previa registrazione e potrà accede tutte le volte successive riutilizzando le credenziali create in fase di registrazione.

Una volta eseguito il login, l'utente potrà esaminare una serie di prodotti e scegliere quali e quanti di questi aggiungere al carrello.

La compravendita si conclude quando l'utente, una volta entrato nel carrello, procede al pagamento (simulato) seguendo una delle modalità proposte.

Gli ordini saranno salvati nella sezione del suo profilo e consultabili liberamente, così come eventuali messaggi generati duarente l'utilizzo della piattaforma.

### Venditore

Il venditore avrà a disposizione un'interfaccia del tutto simile a quella proposta a un compratore. Principalmente questa si differenzia nella possibilità di aggiungere, modificare o rimuovere i prodotti che poi saranno visibili a potenziali acquirenti.

Il venditore è in grado di ottenere la lista di tutti gli ordini eseguiti dai compratori consultando l'apposita sezione nel suo profilo.

## Dipendenze

Il sito si appoggia su un database. Per fornire un struttura funzionante, il file ```unibonsai.sql``` contiene lo script di inizializzazione per creare tutte le tabelle necessarie per dimostrare il funzionamento del sito. Nello specifico si avrà a disposizione:

- Un accesso con username "cliente" e password "cliente" che simula l'accesso come compratore
- Un accesso con username "venditore" e password "venditore" che simula l'accesso come venditore
- Un catalogo di 20 prodotti
- Una carta di pagamento associata a "cliente"
- Un ordine eseguito da "cliente" con diversi prodotti in diverse quantità