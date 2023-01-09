<?php

/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File language/italian.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!defined('IN_NUKE'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("_ok","OK");
define("_error","Errore");
define("_warning","Attenzione");
define("_nextstep","Avanti");
define("_reset","Azzera");

//Step 1
define("_admpupload_dead","Torrenti di Unscrapeable");
define("_admpupload_deadexplain","Usi questo per tenere conto affinch?i torrenti seminati ONU uploaded all'inseguitore che possono essere rimossi al tempo pi? tardo.");
define("_step1","Passo 1: Requisiti di Installazione");
define("_phpvercheck","Controllo versione di PHP");
define("_phpverfail","La versione minima di PHP richiesta &egrave; la 4.3");
define("_zlibcheck","Controllo librerie Zlib");
define("_zlibfail","L'installazione di Zlib permette di risparmiare banda sull'output");
define("_mysqlcheck","Controllo MySQL");
define("_mysqlfail","Devi avere i Connettori MySQL per usare il Database");
define("_domxmlcheck","Controllo DOM XML preinstallato");
define("_domxmlnotinstalled","DOM XML non &egrave; caricato in PHP. Questo potrebbe influire sulle prestazioni.");
define("_domxmlload","Caricamento di DOM XML da libreria esterna");
define("_domxmlcantload","Impossibile caricare DOM XML. Controlla come compilarlo e installarlo. &Egrave; un componente richiesto, ma potresti comunque esserein grado di usare il Tracker.");
define("_externalcheck","Controllo connessioni in uscita");
define("_externalfail","Impossibile aggiornare le statistiche dei Torrent Esterni in tempo reale n&egrave; distinguere gli utenti Attivi da quelli Passivi");
define("_oscheck","Controllo Sistema Operativo");

define("_step1fail","Non &egrave; possibile continuare l'installazione di phpMyBitTorrent perch&egrave; i requisiti minimi non sono rispettati.");
define("_step1warn","L'installazione pu?proseguire, ma alcune funzioni potrebbero non essere disponibili.");

//Step 2
define("_step2","Passo 2: Accordo di Licenza");
define("_gpllicense","Per installare phpMyBitTorrent, devi accettare tutti i termini della licenza GNU/GPL,
sotto la quale phpMyBitTorrent viene rilasciato.");
define("_lgpllicense","Allo stesso modo devi accettare tutti i termini della licenza GNU/LGPL, perch&egrave;
phpMyBitTorrent fa uso di librerie Open Source rilasciate sotto tale licenza.");
define("_iagree","Accetto");
define("_idontagree","Non Accetto");
define("_step2fail","Non puoi procedere prima di aver accettato entrambe le licenze.");

//Step 3
define("_step3","Passo 3: Configurazione di base");
define("_step3explain","Ora puoi configurare le impostazioni basilari di phpMyBitTorrent.
Queste impostazioni includono i dati di accesso al database (username, password...) e alcune impostazioni
avanzate come l'uso di cookie sicuri e la directory di upload dei Torrent. Ulteriori dettagli di seguito.");
define("_dbconfig","Configurazione Database");
define("_dbtype","Tipo di Database");
define("_dbtypeexplain","Attualmente sono supportati solo database MySQL. Indica se usi una versione inferiore o superiore alla 4.0");
define("_dbhost","Server di Database");
define("_dbhosterror","Host non raggiungibile.");
define("_dbuser","Nome utente di accesso");
define("_dbusererror","Impossibile accedere con questa coppia nome utente/password.");
define("_dbpass","Password di accesso");
define("_dbname","Nome del Database");
define("_dbnameerror","Impossibile utilizzare questo database. Potrebbe essere inaccessibile o inesistente.");
define("_dbprefix","Prefisso Tabelle");
define("_dbpers","Connessione Persistente");
define("_moresettings","Ulteriori Impostazioni");
define("_uploaddirectory","Directory di Upload.");
define("_updirnoexist","La directory non esiste.");
define("_updirnowrite","La directory non &egrave; scrivibile.");
define("_mustwritable","Deve essere scrivibile");
define("_serverreturned","Il Server ha restituito: <b>**msg**</b>");
define("_securecookies","Cookie Sicuri");
define("_rsacookies","Abilita Sicurezza RSA&reg;");
define("_rsamod","Modulo");
define("_pubkey","Chiave Pubblica");
define("_privkey","Chiave Privata");
define("_makedircmd","Per creare la directory, accedi come <i>**user**</i> al server e lancia il seguente comando dalla shell: <u>**cmd**</u>");
define("_permissioncmd","Per rendere la directory scrivibile, accedi come <i>**user**</i> al server e lancia il seguente comando dalla shell: <u>**cmd**</u>");
define("_cannotwriteconfig","Impossibile salvare il file di configurazione automaticamente. Crea un file di nome configdata.php nella directory include/ e inserisci il codice di seguito riportato");
define("_step3complete","Configurazione completata. Adesso puoi installare il database di phpMyBitTorrent.");

//Step 4
define("_step4","Passo 4: Installazione del Database");
define("_checkingfiles","Controllo file...");
define("_step4fnotfound","Errore Critico. Impossibile leggere il file **file**. Controlla l'integrit&agrave; del pacchetto e i permessi di accesso ai file.");
define("_nuke_sql_error1","Errore nella Query SQL ");
define("_nuke_sql_error2","ID errore: ");
define("_nuke_sql_error3","Messaggio di errore: ");
define("_tblcreating","Creazione della tabella <b>**table**</b>...");
define("_installcategories","Creazione delle categorie predefinite...");
define("_installsmiles","Installazione emoticon predefinite...");
define("_step4failed","Si &egrave; verificato un Errore di Installazione che non consente di proseguire. Correggi l'errore e prova a riavviare il programma di installazione, o ad aggiornare la pagina sul tuo browser.");
define("_step4complete","L'installazione del database &egrave; stata completata con successo. Adesso puoi configurare il tuo tracker in base alle tue preferenze.");

//Step 5
define("_admpauto_clean","Auto Clean Timer");
define("_admpauto_cleanexplain","Sets the time intervals Of the clean sessions. For like with the bonus system.");

define("_admpmax_members","Max allowed Members");
define("_admpmax_membersexplain","Max number of members allowed to join your site.");

define("_admpinvite_only","Inite Only");
define("_admpinvite_onlyexplain","Only allows for users to join if they have been invited.");

define("_admpinvites_open","Invite system");
define("_admpinvites_openexplain","turn on and off the invite system.");

define("_step5","Passo 5: Configurazione di phpMyBitTorrent");
define("_step5explain","Ora devi configurare il tuo nuovo tracker phpMyBitTorrent. Di seguito sono riportati tutti i parametri di configurazione che ti permetteranno
di personalizzare ogni aspetto del Tracker. Tuttavia, solo i parametri fondamentali necessitano di essere impostati correttamente. Potrai sempre cambiare le impostazioni
entrando come Amministratore nel Pannello di Configurazione.");
define("_basicsettings","Impostazioni di Base");
define("_advancedsettings","Impostazioni Avanzate");
define("_admpsitename","Nome del Sito");
define("_admpsitenameexplain","Il nome di questa installazione di phpMyBitTorrent. Verr&agrave; visualizzato come titolo pagina.");
define("_admpsiteurl","URL del sito");
define("_admpsiteurlexplain","Indirizzo URL di questo sito. Richiesto per il funzionamento del Tracker.");
define("_admpcookiedomain","Dominio dei Cookie");
define("_admpcookiedomainexplain","Dominio dei Cookie. Il dominio a cui appartiene questo sito (es. tuosito.com). Necessario per il login degli utenti.");
define("_admpcookiepath","Percorso dei Cookie");
define("_admpcookiepathexplain","Percorso dei Cookie. Cambia questo parametro <b>solo</b> se phpMyBitTorrent &egrave; installato in una sottodirectory sul server.");
define("_admpuse_gzip","Utilizza compressione GZIP");
define("_admpuse_gzipexplain","Questa opzione permette di abilitare o meno la compressione GZIP di PHP sulle pagine e sull'output del tracker. Se attivata, verr?risparmiata banda ma l'uso della CPU del server sar?maggiore. Inoltre si ?visto che non ?sempre possibile utilizzare questa funzionalit?a causa dell'incompatibilit?di alcuni server. Verificare che il proprio client di Bit Torrent legga correttamente l'output del tracker.");
define("_admpadmin_email","E-Mail Amministratore");
define("_admpadmin_emailexplain","Indirizzo email da cui risulteranno spedite tutte le comunicazioni agli utenti (registrazione, autorizzazioni, ecc.). Non &egrave; necessario che sia un indirizzo vero, tuttavia &egrave; bene che sia identificativo per questo sito.");
define("_admplanguage","Lingua di default");
define("_admplanguageexplain","Specifica la lingua di default da utilizzare quando l'impostazione lingua non &egrave; impostata su Automatico.");
define("_admptheme","Tema");
define("_admpthemeexplain","Imposta il tema di default per questo sito. Gli utenti registrati possono scavalcare questa opzione dal loro pannello di controllo.");
define("_admpwelcome_message","Messaggio di Benvenuto");
define("_admpwelcome_messageexplain","Se impostato, definisce il messaggio che gli utenti visualizzeranno in cima alla Home Page. Se non impostato, essi vedranno il messaggio di benvenuto predefinito nella loro lingua. L'uso di HTML  &egrave; consentito senza limitazioni.");
define("_admpannounce_text","Messaggio del Tracker");
define("_admpannounce_textexplain","Se impostato, definisce il messaggio che gli utenti visualizzeranno nel loro client BitTorrent all'atto della connessione al Tracker. Utile per avvisi e promozioni.");
define("_admpallow_html","Utilizza HTML Avanzato");
define("_admpallow_htmlexplain","Abilita questa opzione per permettere agli utenti di scrivere descrizioni Torrent in HTML utilizzando la versione di FCKeditor fornita con phpMyBitTorrent.<br /><b>ATTENZIONE</b>: la funzionalit&agrave; &egrave; ancora sperimentale!");
define("_admprewrite_engine","SearchRewrite");
define("_admprewrite_engineexplain","SearchRewrite trasforma i complessi URL di PHP in finte pagine HTML, molto pi&ugrave; gradevoli da digitare sulla barra degli indirizzi del browser. Questo sistema &egrave; particolarmente utile per favorire l'indicizzazione del sito da parte dei motori di ricerca. RICHIEDE il mod_rewrite di Apache o il modulo aggiuntivo ISAPI_Rewrite di IIS.");
define("_admptorrent_prefix","Prefisso Torrent");
define("_admptorrent_prefixexplain","Permette di aggiungere un prefisso al nome file di tutti i Torrent in download su questo tracker. Utile per diffondere nome o indirizzo del tracker.");
define("_admptorrent_per_page","Torrent per pagina");
define("_admptorrent_per_pageexplain","Indica quanti Torrent possono essere visualizzati ogni pagina, sia nel listing che durante le ricerche.");
define("_admponlysearch","Solo Ricerca");
define("_admponlysearchexplain","Disabilita la lista dei Torrent ai non Amministratori. Gli utenti (registrati o no) devono effettuare una ricerca per trovare il Torrent di cui necessitano.");
define("_admpmax_torrent_size","Dimensione massima Torrent");
define("_admpmax_torrent_sizeexplain","Dimensione massima (in byte) per i file .torrent in upload. Al conteggio della dimensione NON contribuiscono i file associati al Torrent!");
define("_admpannounce_interval","Intervallo Announce");
define("_admpannounce_intervalexplain","Valore da comunicare al client per l'intervallo minimo di tempo (in secondi) prima di una nuova richiesta di Announce.");
define("_admpannounce_interval_min","Intervallo Announce Minimo");
define("_admpannounce_interval_minexplain","Intervallo minimo che deve trascorrere tra due richieste Announce. Richieste troppo frequenti saranno rifiutate.");
define("_admpdead_torrent_interval","Durata Torrent Morti");
define("_admpdead_torrent_intervalexplain","Indica quanti secondi &egrave; necessario aspettare prima che un Torrent morto (senza peer connessi) venga nascosto dalla visualizzazione.");
define("_admpminvotes","Voti Minimi");
define("_admpminvotesexplain","Numero minimo di voti prima di visualizzare il rapporto di gradimento del Torrent.");
define("_admptime_tracker_update","Tempo di Aggiornamento Tracker Esterni");
define("_admptime_tracker_updateexplain","Specifica l'intervallo di aggiornamento dei Tracker Esterni in secondi. Richiede Autoscrape abilitato.");
define("_admpbest_limit","Limite Best Torrent");
define("_admpbest_limitexplain","Numero di peer al di sopra del quale il Torrent viene incluso nella Top List.");
define("_admpdown_limit","Limite Torrent Morti");
define("_admpdown_limitexplain","Numero di peer al di sotto del quale il Torrent viene incluso nella lista dei Torrent morti.");
define("_admptorrent_complaints","Lamentele Torrent");
define("_admptorrent_complaintsexplain","Permette agli utenti di valutare i Torrent in base al loro contenuto nel tentativo di bloccare file illegali, come quelli pedofili, nel pi&ugrave; breve tempo possibile. I Torrent che ottengono un numero sufficiente di lamentele vengono automaticamente bannati. Gli Amministratori possono visionare le ultime segnalazioni in Amministrazione.");
define("_admptorrent_global_privacy","Protezione Privacy");
define("_admptorrent_global_privacyexplain","Protezione Privacy permette agli utenti che caricano Torrent di porre limitazioni di download agli altri utenti. Grazie ad un sicuro sistema di autorizzazioni, sar&agrave; il proprietario del Torrent a scegliere chi pu&ograve; scaricare cosa.Questa impostazione impedisce automaticamente il download agli utenti non registrati quando il Torrent &egrave; associato ad un utente. Se questa opzione viene disattivata, il download sar&agrave; consentito a seconda delle impostazioni di download globali.");
define("_admpdisclaimer_check","Disclaimer");
define("_admpdisclaimer_checkexplain","Specifica se l'utente che intende registrarsi deve prima accettare un disclaimer, ossia un regolamento con note legali che ricorda all'utente quali sono le responsabilit&agrave; derivate dalla condivisione dei file.");
define("_admpgfx_check","Test di Turing");
define("_admpgfx_checkexplain","Specifica se utilizzare una speciale protezione grafica su alcune pagine. Il codice di sicurezza garantisce protezione contro i BOT automatici di registrazione e azioni non volute da parte degli utenti.");
define("_admpupload_level","Livello di accesso all'upload");
define("_admpupload_levelexplain","Determina i requisiti di accesso per l'upload di Torrent<ul><li><b>TUTTI</b> permette a tutti gli utenti non registrare di effettuare l'upload di Torrent. Non potranno per&ograve; modificare i Torrent o gestirne le Autorizzazioni<li><b>REGISTRATI</b> richiede la registrazione per l'upload</ul>");
define("_admpupload_levelopt1","Tutti");
define("_admpupload_levelopt2","Registrati");
define("_admpupload_levelopt3","Premium");
define("_admpdownload_level","Livello di accesso al download");
define("_admpdownload_levelexplain","<ul><li><b>TUTTI</b> permette il download indistinto dei Torrent<li><b>REGISTRATI</b> richiede la registrazione<li><b>PREMIUM</b> permette solo agli utenti Premium di scaricare un .torrent dal sito</ul>Questa opzione non influenza l'utilizzo del tracker.");
define("_admpdownload_levelopt1","Tutti");
define("_admpdownload_levelopt2","Registrati");
define("_admpdownload_levelopt3","Premium");
define("_admpannounce_level","Livello di accesso al tracker");
define("_admpannounce_levelexplain","<ul><li><b>TUTTI</b> permette a chiunque di effettuare richieste Announce<li><b>REGISTRATI</b> richiede che l'utente abbia effettuato il login (viene controllato l'IP!)</ul>Questa opzione non influenza il download dei file Torrent dal sito.");
define("_admpannounce_levelopt1","Tutti");
define("_admpannounce_levelopt2","Registrati");
define("_admpmax_num_file","Massimo numero di file per Torrent");
define("_admpmax_num_fileexplain","Limite al numero di file oltre il quale il Torrent non pu&ograve; essere accettato in upload. Un ragionevole modo per incentivare l'uso della compressione dei file. Impostando a zero l'opzione essa verr&agrave; ignorata.");
define("_admpmax_share_size","Dimensione massima Share per Torrent");
define("_admpmax_share_sizeexplain","Limite di share (dimensione dei file associati) oltre il quale il Torrent non viene accettato in upload. L'upload di archivi di non eccessive dimensioni (dividendo una grande collezione, ad esempio) permette agli utenti di scaricare solo i file che interessano e allo stesso tempo, diminuendo i tempi di download per ogni Torrent garantisce un buon rapporto leech/seed. Impostando a zero l'opzione essa verr&agrave; ignorata.");
define("_admpglobal_min_ratio","Ratio Minima Globale");
define("_admpglobal_min_ratioexplain","Questa opzione blocca l'uso del tracker da parte degli utenti con ratio inferiore a quella impostata. L'opzione si applica solo se il Livello di Accesso Announce &egrave; impostato su Utenti Registrati, e non influisce il download dei file Torrent. Impostandola a zero la funzionalit&agrave; viene disattivata.");
define("_admpautoscrape","Autoscrape");
define("_admpautoscrapeexplain","Autoscrape ti permette di aggiornare le statstiche per i Torrent Esterni.<br>USA QUESTA OPZIONE CON CAUTELA!!<br>Puoi usare Autoscrape SOLO se il tuo server &egrave; in grado di aprire socket con qualsiasi client sulla Rete. Molti servizi hosting economici o gratuiti dispongono di firewall che bloccano le connessioni in uscita. Se non usi un Server Dedicato o Casalingo, ti consigliamo di NON abilitare questa opzione a meno che non sei sicuro di ci&ograve; che stai facendo.<br>Se non abiliti Autoscrape tutti i Torrent Esterni verranno visualizzati senza fonti e non potrai farci nulla. Abilitare questa opzione con un server protetto da firewall causer&agrave; un errore di 'Tracker esterno non risponde' al tentativo di upload di Torrent esterni.");
define("_admpmax_num_file_day_e","Massimo numero download giornalieri");
define("_admpmax_num_file_day_eexplain","Definisce quanti download possono essere effettuati da un singolo utente in un'unica giornata. Ulteriori richieste saranno rifiutate e l'utente dovr&agrave; attendere un giorno solare.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpmax_num_file_week_e","Massimo numero download settimanali");
define("_admpmax_num_file_week_eexplain","Definisce quanti download possono essere effettuati da un singolo utente in una settimana. Ulteriori richieste saranno rifiutate e l'utente dovr&agrave; riprovare la settimana successiva.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpmin_num_seed_e","Minimo numero di seed per nuovo download");
define("_admpmin_num_seed_eexplain","Definisce quanti Torrent l'utente deve avere in seed prima di poter scaricare un nuovo file.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpmin_size_seed_e","Minima dimensione seed per nuovo download");
define("_admpmin_size_seed_eexplain","Definisce quanto share l'utente deve avere in seed prima di poter scaricare un nuovo file.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpmaxupload_day_num","Numero massimo di upload giornalieri");
define("_admpmaxupload_day_numexplain","Definisce il massimo numero di Torrent di cui &egrave; possibile fare l'upload in una giornata. Ulteriori upload non verranno accettati e l'utente dovr&agrave; ritentare il giorno successivo.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpmaxupload_day_share","Share massimo in upload giornalmente");
define("_admpmaxupload_day_shareexplain","Definisce la dimensione massima dei Torrent (conteggio dei file associati) di cui &egrave; possibile fare l'upload in una giornata. Ulteriori upload non verranno accettati e l'utente dovr&agrave; ritentare il giorno successivo.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpminupload_size_file","Dimensione minima del Torrent in upload");
define("_admpminupload_size_fileexplain","Definisce la dimensione minima (conteggio file associati) dei Torrent di cui &egrave; possibile effettuare l'upload.<br>Gli utenti Premium non risentono di questa impostazione. Impostando zero, questa funzionalit&agrave; verr&agrave; disabilitata.");
define("_admpallow_backup_tracker","Tracker di Backup");
define("_admpallow_backup_trackerexplain","Abilita il Tracker di Backup secondo l'estensione Announce-List. Valgono le impostazioni di Announce e non ha effetto sulle ratio. L'opzione viene ignorata se la Modalit&agrave; Stealth &egrave; attiva.");
define("_admpstealthmode","Modalit&agrave; Stealth");
define("_admpstealthmodeexplain","La Modalit&agrave; Stealth disabilita e nasconde il tracker dalla Rete. phpMyBitTorrent accetter&agrave; solo Torrent Esterni.");
define("_step5complete","Il Tracker &egrave; stato configurato. Ora puoi creare il tuo account Amministratore e prepararti al login!");

//Step 6
define("_step6","Passo 6: Account Amministratore");
define("_step6explain","Ora che hai configurato il tuo Tracker, devi crearti un account Amministratore. Effettuare il login come Amministratore ti permetter&agrave;
di accedere al Pannello Amministrativo per avere pieno controllo sul Tracker. Gli Amministratori agiscono come Superutenti. Ricorda che puoi cambiare le impostazioni personali
nel tuo Profilo.");
define("_username","Nome Utente");
define("_password","Password");
define("_passwordconf","Conferma Password");
define("_email","Indirizzo E-Mail");
define("_fullname","Nome Completo (opzionale)");
define("_usernamereq","Il Nome Utente &egrave; obbligatorio!");
define("_usernametoolong","Il Nome Utente non pu&ograve; superare i 25 caratteri!");
define("_passwordreq","La Password &egrave; richiesta!");
define("_passwordnomatch","Le Password non coincidono!");
define("_emailinvalid","&Egrave; richiesto un indirizzo E-Mail valido!");
define("_step6complete","Account Amministratore registrato correttamente. Adesso il tracker &egrave; quasi pronto per l'installazione.");

//Step 7
define("_step7","Completamento dell'Installazione");
define("_step7explain","Congratulazioni! phpMyBitTorrent &egrave; stato installato e configurato correttamente. Ora non ti resta che avviare il tuo nuovo Tracker
e iniziare a condividere file! Prima di cominciare tieni presente quanto segue:");
define("_thingstodo","<ul>\n
<li><p>Cancella la directory <i>setup</i> dell'installazione! Per motivi di sicurezza phpMyBitTorrent si bloccher?fino a quando la directory non sar?cancellata.</p></li>\n
<li><p>Usa l'account che hai appena creato per impostare nel dettaglio le preferenze del Tracker e impara a usarle al meglio per creare la tua community peer-to-peer. Non rivelare a nessuno la tua password di Amministratore</p></li>\n
<li><p>Ricorda di eseguire di tanto in tanto l'Ottimizzatore Database, uno strumento fondamentale per mantenere efficiente il Tracker quando il carico del server aumenta</p></li>\n
<li><p>Se hai bisogno di farti aiutare nella gestione del Tracker da altri utenti fidati, ricorda che i Moderatori possono gestire liberamente i Torrent senza per?poter entrare nel Pannello Amministrativo</p></li>\n
<li><p>Ricorda infine che lo scambio di cultura ?libert? ma la pirateria ?un crimine.</p></li>\n
<li><p>Se phpMyBitTorrent ti piace, perch?non fai una piccola <b>donazione</b> a chi lo ha creato in modo da mantenere il progetto attivo?</p></li>\n
</ul>\n");
define("_thanks","Grazie da parte del Team di phpMyBitTorrent per aver scelto questo fantastico prodotto Open Source!");
define("_enter","Entra in phpMyBitTorrent");

?>