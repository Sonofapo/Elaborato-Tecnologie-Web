# UniBonsai

Questo repository contiene il progetto d'esame per Tecnologie Web creato da Alex Giamperoli e Antonio Emanuele Pepe durante l'anno accademico 2021/2022

## Descrizione

Il progetto in questione vuole offrire un sito web per la gestione e compravendita di prodotti, nello specifico bonsai di vario genere.

## Utilizzo

### Compratore

Il sito è utilizzabile da qualsiasi utente previa registrazione e potrà accede tutte le volte successive riutilizzando le credenziali create in fase di registrazione.

Una volta eseguito il login, l'utente potrà esaminare una serie di prodotti e scegliere quali e quanti di questi aggiungere al carrello.

La compravendita si conclude quando l'utente, una volta entrato nel carrello, procede al pagamento (simulato) seguendo una delle modalità proposte.

Gli ordini saranno salvati nella sezione del suo profilo e consultabili liberamente, così come eventuali messaggi generati durante l'utilizzo della piattaforma.

### Venditore

Il venditore avrà a disposizione un'interfaccia del tutto simile a quella proposta a un compratore. Principalmente questa si differenzia nella possibilità di aggiungere, modificare o rimuovere i prodotti che poi saranno visibili a potenziali acquirenti.

Il venditore è in grado di ottenere la lista di tutti gli ordini eseguiti dai compratori consultando l'apposita sezione nel suo profilo.

### Sistema di notifiche

Come detto, le notifiche sono consultabili nella sezione del profilo di ciascun utente. Le notifiche sono di vario tipo, specifiche per utente ma in generale sono generate in seguito ad un'interazione che si rende utile tener traccia.

Per fare un esempio, il venditore riceverà una notifica ogni qual volta un determinato prodotto dovesse esaurire le sue scorte.

### Scelte di progetto

Durante la progettazione sono state fatte alcune scelte che possono influire sull'esperienza d'uso. Nello specifico:

- Sulla piattaforma possono accedere più venditori ma questi vedranno e gestiranno gli stessi prodotti, così come riceveranno le stesse notifiche
- L'ordine massimo può essere di 100 prodotti per volta, ovviamente nel limite delle disponibilità di ogni singolo prodotto
- L'accesso di un qualsiasi utente perdura per la sola sessione del browser. Non sono previsti accessi automatici

## Dipendenze

Il sito si appoggia su un database. Per fornire una struttura funzionante, il file ```unibonsai.sql``` contiene lo script di inizializzazione per creare tutte le tabelle necessarie per dimostrare il funzionamento del sito. Nello specifico si avrà a disposizione:

- Un accesso con username "cliente" e password "cliente" che simula l'accesso come compratore
- Un accesso con username "venditore" e password "venditore" che simula l'accesso come venditore
- Un catalogo di 20 prodotti
- Una carta di pagamento associata a "cliente"
- Un ordine eseguito da "cliente" con diversi prodotti in diverse quantità

L'accesso al database tramite mysqli avviene tramite l'utente "unibonsai" con password "unibonsai1!". Lo script ```user.sql``` permette di creare tale utente con i permessi necessari alla gestione delle tabelle utilizzate durante il funzionamento.