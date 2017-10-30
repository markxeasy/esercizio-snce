## esercizio gestione prodotti Snce ##
=============

##Guida di installazione##
- Installare l'ultima versione di Symfony seguendo i passi presenti sul [sito ufficiale](https://symfony.com/download)
- Clonare il progetto nella cartella desiderata
- Modificare il file **app/config/parameters.yml** con i dati del database
- Navigare col terminale nella cartella del progetto
- Eseguire il comando `php bin/console doctrine:database:create`
- Eseguire il comando `php bin/console server:run` o l'equivalente per far partire l'istanza locale
- Aprire il browser e andare all'URL dell'applicazione

##Consegna##
Specifiche:
===========

1) Pagina "Crea Prodotto"
La pagina risponde alla rotta /product/create
Come amministratore del sito voglio poter inserire una nuova tipologia di prodotto all'interno di un catalogo.
   - Voglio definirne il nome
   - Voglio poter caricare un'immagine
   - Voglio poter inserire una descrizione
   - Voglio poter aggiungere uno o più tag (almeno uno è obbligatorio) al prodotto

   
2) Pagina "Listato Prodotti"
La pagina di listato risponde alla rotta /product/list
Come amministratore del sito voglio vedere il catalogo di tutti i prodotti da me inseriti in una lista, dove vedo il nome e un'anteprima dell'immagine ridotta, i prodotti sono ordinati per data di creazione. 
Vedo la data di creazione accanto a ciascun prodotto.
Voglio inoltre poter filtrare per ricerca LIKE sul nome dei tag associati.


3) Pagina "Edit Prodotto"
La pagina di modifica risponde alla rotta /product/{product}/edit
Come amministratore del sito cliccando sul link di una riga della lista o sull'immagine, voglio andare al form di modifica delle proprietà del prodotto. 


Richieste implementative:
=========================
- Il progetto deve essere realizzato utilizzando Symfony3
- Doctrine 2 deve essere utilizzato per la gestione del Database 
- Usa i Bundle/Package/Component in maniera significativa
- Puoi usare qualsiasi bundle o package per gestire l'upload delle immagini col framework scelto
- Correda il repository di un readme.md che aiuti nella configurazione del progetto
- Non serve che tu implementi un meccanismo di autenticazione per l'area amministrativa
- Utilizza i Repository di Doctrine 2


Il lavoro valutato per:
=====================
- Completezza rispetto alle specifiche
- Organizzazione e struttura del progetto
- Organizzazione e struttura del codice
- Eleganza delle soluzioni adottate
 
 
Modalità di rilascio:
=====================
Il progetto deve essere rilasciato su repository pubblico github
