<?php

/************************************************************************/
/* Deutsche Sprachdatei / German languagefile                           */
/* for HTML Newsletter Module Version 1.3        www.montegoscripts.com */
/* Filename: MS_HNL_130.zip                                             */
/* ==================================================================== */
/* By WarpSpeed (Marco Wiesler) (warpspeed@4thDimension.de) @ Feb/2oo6  */
/* http://www.warp-speed.de @ 4thDimension.de Networking                */
/* ==================================================================== */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/************************************************************************
* Funktion: Generelle Definitionen
************************************************************************/

define("_MSNL_COM_LAB_MODULENAME","HTML Newsletter");
define("_MSNL_LAB_ADMIN","Administration<br><i><font size=\"1\">
Deutsche &Uuml;bersetzung von <a href=\"http://www.warp-speed.de\" target=\"_blank\">Warp-Speed.de</a></i></font>");

//Modul Menübeschriftungen und Linkbezeichungen
define("_MSNL_LAB_CREATENL","Erstelle&nbsp;Newsletter");
define("_MSNL_LAB_MAINCFG","Haupt&nbsp;Konfig");
define("_MSNL_LAB_CATEGORYCFG","Kategorie&nbsp;Konfig");
define("_MSNL_LAB_MAINTAINNLS","Verwalte&nbsp;Newsletter");
define("_MSNL_LAB_SENDTESTED","Sende&nbsp;getestete");
define("_MSNL_LAB_SITEADMIN","Seiten&nbsp;Administration");
define("_MSNL_LAB_NLARCHIVES","Archive");
define("_MSNL_LAB_NLDOCS","Online&nbsp;Dokumentation");
define("_MSNL_LNK_CREATENL","Erstelle einen Newsletter");
define("_MSNL_LNK_MAINCFG","Moduloptionen konfigurieren");
define("_MSNL_LNK_CATEGORYCFG","Verwalte Liste der Newsletter Kategorien");
define("_MSNL_LNK_MAINTAINNLS","Verwalte existierende Newsletter");
define("_MSNL_LNK_SENDTESTED","Sende den letzten getesteten Newsletter");
define("_MSNL_LNK_SITEADMIN","Zur Portal-Administration");
define("_MSNL_LNK_NLARCHIVES","Liste der Newsletterarchive einsehen");
define("_MSNL_LNK_NLDOCS","Online HTML Newsletter Dokumentation einsehen");
define("_MSNL_ERR_NOTAUTHORIZED","Sie haben keine Berechtigung dieses Modul zu administrieren");

//F&uuml;r Modul functions.php (nicht admin/functions.php)
define("_MSNL_COM_ERR_SQL","SQL FEHLER");
define("_MSNL_COM_ERR_MODULE","FEHLER IM MODUL");
define("_MSNL_COM_ERR_VALMSG","DIE FOLGENDEN FELDER SCHEITERTEN EINER &Uuml;BERPR&Uuml;FUNG");
define("_MSNL_COM_ERR_VALWARNMSG","DIE FOLGENDEN FELDER ENTHALTEN WARNUNGEN");
define("_MSNL_COM_ERR_DBGETCFG","Fehler beim auslesen der Modulkonfiguration!");

//Allgemeine Definitionen
define("_MSNL_COM_LAB_ACTIONS","Aktionen");
define("_MSNL_COM_LAB_ACTIVE","Aktiv");
define("_MSNL_COM_LAB_ADD","Zuf&uuml;gen");
define("_MSNL_COM_LAB_ALL","ALLE");
define("_MSNL_COM_LAB_GO","OK");
define("_MSNL_COM_LAB_INACTIVE","Inaktiv");
define("_MSNL_COM_LAB_LANG","Sprache");
define("_MSNL_COM_LAB_NO","Nein");
define("_MSNL_COM_LAB_PREVIEW","Vorschau");
define("_MSNL_COM_LAB_SAVE","SPEICHERN");
define("_MSNL_COM_LAB_SHOW_ALL","**Zeige alle**");
define("_MSNL_COM_LAB_SEND","Senden");
define("_MSNL_COM_LAB_VERSION","Version");
define("_MSNL_COM_LAB_YES","Ja");
define("_MSNL_COM_LNK_ADD","Klicken um die obigen Daten zuzuf&uuml;gen");
define("_MSNL_COM_LNK_CANCEL","Vorgang abbrechen");
define("_MSNL_COM_LNK_CONTINUE","Vorgang fortsetzen");
define("_MSNL_COM_LNK_SAVE","Klicken um die obigen Daten zu speichern");
define("_MSNL_COM_LNK_SEND","Sende Newsletter");
define("_MSNL_COM_LNK_PREVIEW","&Uuml;berpr&uuml;fung und Vorschau des Newsletters");
define("_MSNL_COM_ERR_SQL","SQL");
define("_MSNL_COM_ERR_MSG","FEHLER MSG");
define("_MSNL_COM_ERR_DBGETCATS","Fehler beim auslesen der Newsletter Kategorien");
define("_MSNL_COM_ERR_FILENOTEXIST","Datei existiert nicht");
define("_MSNL_COM_ERR_DBGETPHPBB","phpBB Forum Konfiguration wurde nicht gefunden");
define("_MSNL_COM_ERR_DBGETRECIPIENTS","Konnte Zahl der Empf&auml;nger nicht auslesen:");
define("_MSNL_COM_MSG_WARNING","Warnung!");
define("_MSNL_COM_MSG_UPDSUCCESS","Update war erfolgreich!");
define("_MSNL_COM_MSG_ADDSUCCESS","Eintrag war erfolgreich!");
define("_MSNL_COM_MSG_DELSUCCESS","L&ouml;schen war erfolgreich!");
define("_MSNL_COM_MSG_REQUIRED","Ben&ouml;tigtes Feld, muss ausgef&uuml;llt werden");
define("_MSNL_COM_MSG_POSNONZEROINT","Ben&ouml;tigt einen positiven, nicht null, Wert");
define("_MSNL_COM_HLP_ACTIONS","Bewegen sie den Mauszeiger "
	."&uuml;ber jedes unten aufgef&uuml;hrte Icon, um zu sehen was es f&uuml;r eine Aktion ausl&ouml;st."
	);

/************************************************************************
* Funktion: msnl_admin  (Create Newsletter)
************************************************************************/

//Sektion: Brief
define("_MSNL_ADM_LAB_LETTER","Brief");
define("_MSNL_ADM_LAB_TOPIC","&Uuml;berschrift");
define("_MSNL_ADM_LAB_SENDER","Sendername");
define("_MSNL_ADM_LAB_NLSCAT","Kategorie");
define("_MSNL_ADM_LAB_TEXTBODY","Newsletter Text");
define("_MSNL_ADM_LAB_HTMLOK","(HTML Tags sind erlaubt)");
define("_MSNL_ADM_HLP_TOPIC","Dieser Text ersetzt die Betreffzeile {EMAILTOPIC}, in der "
	."genutzten Vorlage. Da hier f&uuml;r nur eine Zeile zur Verf&uuml;gung steht, sollten es max. "
	."40 Zeichen oder weniger sein, die genutzt werden. Nur folgende HTML Tags sind erlaubt "
	."in diesem Feld: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_SENDER","Dieser Text ersetzt den Sender {SENDER} des Newsletters, "
	."in der genutzten Vorlage.  Da hierf&uuml;r nur eine Zeile zur Verf&uuml;gung steht, sollten es max. "
	."20 Zeichen oder weniger sein, die genutzt werden. Nur folgende HTML Tags sind erlaubt "
	."in diesem Feld: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_NLSCAT","W&auml;hlen sie einfach die Newsletter Kategorie, zu der der Newsletter "
	."geh&ouml;rt. Kategorien k&ouml;nnen dazu genutzt werden, um  Newsletter in verschiedene "
	."Schl&uuml;ssel-Kategorien aufzuteilen. Newsletter k&ouml;nnen auch ihrer zugeh&ouml;rigen Kategorie nach "
	."sortiert bzw. dargestellt werden. Dies kann in der Konfiguration des Newslettersmoduls eingestellt werden."
	);
define("_MSNL_ADM_HLP_TEXTBODY","Dies ist der Haupttext des Newsletters. Es ist empfehlenswert, "
	."den Text bzw. den Newsletter zuerst in einem WYSIWYG Editor zu erstellen. Dann kann er "
	."via Copy&Paste leicht eingef&uuml;gt werden. Dieser ersetzt dann den {TEXTBODY} in der genutzten Vorlage."
	."<br /><br />HTML Tags sind erlaubt sollten aber mit Bedacht genutzt werden, damit sie auf vielen "
	."e-Mail Clients gut lesbar und nicht &uuml;bertrieben sind.<br /><br />"
	."Bei langen Texten k&ouml;nnen sie <b>&Uuml;bersichtspunkte</b> setzen, um direkt an eine bestimmte Stelle zu springen. "
	." Geben sie ihnen eindeutige Namen und setzen sie einen Haken bei der <b>&Uuml;bersichtspunkte einf&uuml;gen "
	."</b>Option. Dadurch werden diese <b>&Uuml;bersichtspunkte</b> zu Links innerhalb der \"Tabellen&uuml;bersicht\" "
	."ihres Newsletters!<br /><br />Eins k&ouml;nnte zum Beispiel wie folgt lauten: "
	."<b>& lt;a name=\"Bereich Eins\"& gt;& lt;/a& gt;</b>. <b>HINWEIS:</b> Es muss GENAUSO gemacht werden "
	."wie angegeben. Mit Anf&uuml;hrungszeichen UND abschließendem Link Tag! Dieses Beispiel erzeugt einen Link Namens "
	."<b>Bereich Eins</b> innerhalb der \"Tabellen&uuml;bersicht\". Beim anklicken eines Links wird der Leser direkt "
	."an dessen Stelle im Text des Newsletters verwiesen."
	);

//Sektion: Vorlagen
define("_MSNL_ADM_LAB_TEMPLATES","Vorlagen");
define("_MSNL_ADM_LAB_CHOOSETMPLT","Vorlage ausw&auml;hlen");
define("_MSNL_ADM_LNK_SHOWTEMPLATE","Anklicken um eine Vorschau der Vorlage zu sehen");
define("_MSNL_ADM_HLP_TEMPLATES","Diese Liste beinhaltet alle ihrer unter "
	."modules/HTML_Newsletter/templates/ abgelegten Vorlagen. Wenn sie ohne Vorlage arbeiten,"
	." sendet das System den reinen Text den sie oben im Feld <b>Newsletter Text</b> eingegeben haben."
	."<br /><br />Um einen Newsletter mit Hilfe einer Vorlage zu schicken, w&auml;hlen sie eine aus der Liste aus. "
	."F&uuml;r eine Vorschau ihres Newsletters, klicken sie auf das <b>Zeige</b> Icon, rechts "
	."neben dem Vorlagenamen.<br /><br />Sie k&ouml;nnen auch eigene Vorlagen erstellen und diese "
	."im Vorlagen-Ordner speichern.  <b>Hinweis:</b> Die Vorlage \"Fancy_Content\" ist die einzige "
	."Vorlage die durch den Autor bei Updates des Moduls mit aktualsiert werden!"
	);

//Sektion: Statistiken und Newsletter Inhalte
define("_MSNL_ADM_LAB_STATS","Statistiken und Newsletterinhalte");
define("_MSNL_ADM_LAB_INCLSTATS","Seitenstatistiken einf&uuml;gen");
define("_MSNL_ADM_LAB_INCLTOC","\"&Uuml;bersichtspunkte\" einf&uuml;gen");
define("_MSNL_ADM_HLP_INCLSTATS","Das aktivieren dieser Funktion f&uuml;gt einige Ihrer Seitenstatistiken in den Newsletter "
	."ein. Diese werden an der Stelle in der Vorlage mit den {STATS} Tag dargestellt. Schauen sie sich "
	."das obige Beispiel an, um eine Vorstellung der dargestellten Statistiken zu erhalten."
	);
define("_MSNL_ADM_HLP_INCLTOC","Das aktivieren dieser Funktion f&uuml;gt einen \"Tabellen&uuml;bersichts\" "
	."'Block', in Vorlagen welche den {TOC} Tag nutzen, ein. Beispiel: siehe Vorlage \"Beispiel "
	."f&uuml;r Fancy_Content\".  Dieser \"Tabellen&uuml;bersichts\" 'Block' zeigt Links zu allen "
	."erstellten <b>&Uuml;bersichtspunkten</b> innerhalb des <b>Newsletter Texts</b>."
	);

//Sektion: Einfügen der "neusten Positionen"
define("_MSNL_ADM_LAB_INCLLATEST","Einf&uuml;gen von aktuellen Dingen");
define("_MSNL_ADM_LAB_INCLLATESTDLS","Neuste Downloads");
define("_MSNL_ADM_LAB_INCLLATESTWLS","Neuste Web-Links");
define("_MSNL_ADM_LAB_INCLLATESTFORS","Neuste Forumbeitr&auml;ge");
define("_MSNL_ADM_LAB_INCLLATESTNEWS","Neuste Newsbeitr&auml;ge");
define("_MSNL_ADM_LAB_INCLLATESTREVS","Neuste Testberichte");
define("_MSNL_ADM_HLP_INCLLATESTNEWS","Zeigt die Anzahl der neusten Artikel, die dem Newsletter "
	."angeh&auml;ngt werden. Die Artikel werden in chronologischer Reihenfolge, neuste zuerst dargestellt."
	." Bei einem Wert von 0 (null) werden keine Verweise zu den neusten Artiklen erstellt. "
	."Die Werte hier sind f&uuml;r jeden Newsletter gleich bleibend, k&ouml;nnen aber zu jeder Zeit "
	."wieder ver&auml;ndert bzw. angepasst werden."
	);
define("_MSNL_ADM_HLP_INCLLATESTDLS","Zeigt die Anzahl der neusten Downloads, die dem Newsletter "
	."angeh&auml;ngt werden. Die Downloads werden in chronologischer Reihenfolge, neuste zuerst dargestellt."
	." Bei einem Wert von 0 (null) werden keine Verweise zu den neusten Downloads erstellt. "
	."Die Werte hier sind f&uuml;r jeden Newsletter gleich bleibend, k&ouml;nnen aber zu jeder Zeit "
	."wieder ver&auml;ndert bzw. angepasst werden."
	);
define("_MSNL_ADM_HLP_INCLLATESTWLS","Zeigt die Anzahl der neusten Web_Links, die dem Newsletter "
	."angeh&auml;ngt werden. Die Web_Links werden in chronologischer Reihenfolge, neuste zuerst dargestellt."
	." Bei einem Wert von 0 (null) werden keine Verweise zu den neusten Web_Links erstellt. "
	."Die Werte hier sind f&uuml;r jeden Newsletter gleich bleibend, k&ouml;nnen aber zu jeder Zeit "
	."wieder ver&auml;ndert bzw. angepasst werden."
	);
define("_MSNL_ADM_HLP_INCLLATESTFORS","Zeigt die Anzahl der neusten Forumbeitr&auml;ge, die dem Newsletter "
	."angeh&auml;ngt werden. Die Forumbeitr&auml;ge werden in chronologischer Reihenfolge, neuste zuerst dargestellt."
	." Bei einem Wert von 0 (null) werden keine Verweise zu den neusten Forumbeitr&auml;gen erstellt. "
	."Die Werte hier sind f&uuml;r jeden Newsletter gleich bleibend, k&ouml;nnen aber zu jeder Zeit "
	."wieder ver&auml;ndert bzw. angepasst werden. Es werden nur &ouml;ffentliche Beitr&auml;ge dargestellt."
	);
define("_MSNL_ADM_HLP_INCLLATESTREVS","Zeigt die Anzahl der neusten Testberichte, die dem Newsletter "
	."angeh&auml;ngt werden. Die Testberichte werden in chronologischer Reihenfolge, neuste zuerst dargestellt."
	." Bei einem Wert von 0 (null) werden keine Verweise zu den neusten Testberichten erstellt. "
	."Die Werte hier sind f&uuml;r jeden Newsletter gleich bleibend, k&ouml;nnen aber zu jeder Zeit "
	."wieder ver&auml;ndert bzw. angepasst werden."
	);

//Sektion: Sponsoren
define("_MSNL_ADM_LAB_SPONSORS","Sponsoren");
define("_MSNL_ADM_LAB_CHOOSESPONSOR","W&auml;hlen sie einen Sponsor");
define("_MSNL_ADM_LAB_NOSPONSOR","Kein Sponsor");
define("_MSNL_ADM_HLP_CHOOSESPONSOR","Der gew&auml;hlte Sponsor wird an die Stelle der Vorlage gesetzt, "
	." die den {BANNER} Tag markiert. Der Banner wird aus dem phpNUKE internen Banner System "
	." ausgelesen"
	);

define("_MSNL_ADM_ERR_DBGETBANNERS","Fehler beim auslesen der Banner Informationen");

//Sektion: An wenn soll der Newsletter geschickt werden
define("_MSNL_ADM_LAB_WHOSNDTO","An wenn soll der Newsletter geschickt werden?");
define("_MSNL_ADM_LAB_CHOOSESENDTO","W&auml;hle der Empf&auml;ngeroption");
define("_MSNL_ADM_LAB_WHOSNDTONLSUBS","Nur Benutzern die einen Newsletter wollen");
define("_MSNL_ADM_LAB_WHOSNDTOALLREG","ALLEN angemeldeten Benutzern");
define("_MSNL_ADM_LAB_WHOSNDTOPAID","Nur bezahlenden (subscribed) Mitgliedern");
define("_MSNL_ADM_LAB_WHOSNDTOANONY","ALLEN Seitenbesuchern - Es werden KEINE e-Mails verschickt aber jeder Besucher "
	."kann den Newsletter online lesen bzw. einsehen"
	);
define("_MSNL_ADM_LAB_WHOSNDTONSNGRPS","Eine oder mehrere NSN Groups (Zusatz-Addon) - Bitte w&auml;hlen");
define("_MSNL_ADM_LAB_WHOSNDTOADM","Test e-Mail (nur zum Admin)");
define("_MSNL_ADM_LAB_SUBSCRIBEDUSRS","Bezahlenden Mitgliedern");
define("_MSNL_ADM_LAB_USERS","Benutzern");
define("_MSNL_ADM_LAB_PAIDUSRS","bezahlenden Mitgliedern");
define("_MSNL_ADM_LAB_NSNGRPUSRS","NSN Groups (Zusatz-Addon) Benutzer");
define("_MSNL_ADM_LAB_WHOSNDTOADHOC","Ad-Hoc e-Mail Adressen");
define("_MSNL_ADM_LAB_WHOSNDTOANONYV","ALLEN Seitenbesuchern");
define("_MSNL_ADM_HLP_WHOSNDTONLSUBS","Diese Option sendet allen, eingetragenen "
	."Benutzer ihres Portals, die einen Newsletter wollen einen"
	." solchen."
	);
define("_MSNL_ADM_HLP_WHOSNDTOALLREG","Diese Option sendet allen ihren eintragenden Benutzern "
	."diesen Newsletter. Seien sie vorsichtig mit dieser Option. So bekommen auch Benutzer ihrers "
	."Portals einen Newsletter die explizit keinen wollen. SPAM Gefahr!"
	);
define("_MSNL_ADM_HLP_WHOSNDTOPAID","Diese Option schickt nur ihren bezahlenden (subscribed ) "
	."Mitgliedern einen Newsletter."
	);
define("_MSNL_ADM_HLP_NSNGRPUSRS","Diese Option erlaubt es ihnen eine oder mehr "
	."NSN Groups (Zusatz-Addon) zu w&auml;hlen, die den Newsletter erhalten sollen."
	);
define("_MSNL_ADM_HLP_WHOSNDTOANONYV","Diese Option verschickt keinen Newsletter "
	."aber er kann im Newsletter Block und im"
	." Archiv eingesehen werden."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADM","Diese Option schick nur dem Administrator der Seite (Ihnen) "
	."diesen Newsletter. Nachdem sie den Newsletter &uuml;berp&uuml;ft haben,"
	." k&ouml;nnen sie ihn via dem <b>Sende getestete</b> Link"
	." (oben im Men&uuml;) an ihre Benutzer schicken."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADHOC","Diese Option schickt den Newsletter an "
	."die von ihnen angegebenen e-Mail Adressen. Sie m&uuml;ssen sie nur durch ein "
	."Komma (<b>,</b>) trennen, sollten es mehrere sein."
	);

//Sektion: NSN Groups
define("_MSNL_ADM_LAB_CHOOSENSNGRP","An welcher NSN Group(en) (Zusatz-Addon) schicken?");
define("_MSNL_ADM_LAB_CHOOSENSNGRP1","(Auswahl wird ignoriert, solange die NSN Group (Zusatz-Addon) Option "
	."nicht gew&auml;hlt wurde)"
	);
define("_MSNL_ADM_LAB_WHONSNGRP","W&auml;hlen sie eine oder mehr Gruppen");

define("_MSNL_ADM_ERR_DBGETNSNGRPS","Fehler beim auslesen der NSN Groups (Zusatz-Addon) Information");

define("_MSNL_ADM_HLP_CHOOSENSNGRPUSRS","W&auml;hlen sie eine oder mehrere Gruppen. Der Newsletter "
	."wird an alle Portalbenutzer geschickt, die sich in jeweilgen Gruppen befinden. Sollte ein "
	."Benutzer in mehreren Gruppen zu finden sein, wird der Newsletter trotzdem nur ein mal zugestellt."
	);

/************************************************************************
* Funktion: msnl_admin_preview  (Erstelle Newsletter --> Vorschau)
************************************************************************/

define("_MSNL_ADM_PREV_LAB_VALPREVNL","Erstelle Newsletter - &Uuml;berpr&uuml;fe und Vorschau");
define("_MSNL_ADM_PREV_LAB_PREVNL","Vorschau des Newsletters");
define("_MSNL_ADM_PREV_MSG_SUCCESS","Der Newsletter bestand der &Uuml;berpr&uuml;fung"
	." und kann als Vorschau angezeigt werden");

/************************************************************************
* Funktion: msnl_admin  (Erstelle Newsletter --> admin_check_post.php)
************************************************************************/

define("_MSNL_ADM_LAB_NSNGRPS","NSN Groups");
define("_MSNL_ADM_VAL_NONSNGRP","Sie wollen den Newsletter an NSN Gruppen Mitglieder schicken, "
	."haben aber keine Gruppe ausgew&auml;hlt"
	);
define("_MSNL_ADM_ERR_NOTEMPLATE","M&ouml;glicher Hackangriff - keine Vorlage gew&auml;hlt");
define("_MSNL_ADM_ERR_NOSENDTO","M&ouml;glicher Hackangriff - keine Sende an Option gew&auml;hlt");
define("_MSNL_ADM_ERR_DBUPDLATEST","Fehler beim updaten der 'Neusten _____' Konfiguration-Information");

/************************************************************************
* Funktion: msnl_admin (Erstelle Newsletter --> admin_send_mail.php)
************************************************************************/

define("_MSNL_ADM_SEND_LAB_SENDNL","Erstelle Newsletter - Sende e-Mail");
define("_MSNL_ADM_SEND_LAB_TESTNLFROM","Teste Newsletter von");
define("_MSNL_ADM_SEND_LAB_NLFROM","Newsletter von");
define("_MSNL_ADM_SEND_MSG_ANONYMOUS","Newsletter wurde f&uuml;r ALLE Besucher zug&auml;nglich zugef&uuml;gt");
define("_MSNL_ADM_SEND_MSG_LOTSSENT","Mehr als 500 Benutzer werden den Newsletter "
	."bekommen. Das kann 10 Minuten oder l&auml;nger dauern... je nach Systemleitung. PHP kann auf einen TimeOut laufen!"
	);
define("_MSNL_ADM_SEND_MSG_TOTALSENT","Gesamtzahl an versandten e-Mails");
define("_MSNL_ADM_SEND_MSG_SENDSUCCESS","Newsletter erfolgreich verschickt");
define("_MSNL_ADM_SEND_MSG_SENDFAILURE","Newsletter wurden nicht verschickt");
define("_MSNL_ADM_SEND_ERR_NOTESTEMAIL","Konnte testemail.php Datei nicht finden");
define("_MSNL_ADM_SEND_ERR_INVALIDVIEW","Vorgabe einer falschen Anzeigeoption");
define("_MSNL_ADM_SEND_ERR_CREATENL","Kann nicht von Testmail zur "
	."Newsletter Datei kopieren"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSINSERT","Es war nicht m&ouml;glich den Newsletter "
	."in die Datenbank einzutragen"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSNID","Es war nicht m&ouml;glich die Newsletter ID des eben "
	."zugef&uuml;gten Newsletters zu lesen"
	);
define("_MSNL_ADM_SEND_ERR_MAIL","PHP-Mailfunktion fehlgeschlagen - Der versandt des Newslettera an "
	."folgende Empf&auml;nger schlug fehl:"
	);
define("_MSNL_ADM_SEND_ERR_DELFILETEST","L&ouml;schen der testemail.php Datei schlug fehl");
define("_MSNL_ADM_SEND_ERR_DELFILETMP","L&ouml;schen der tmp.php Datei schlug fehl");

/************************************************************************
* Funktion: msnl_admin (Erstelle Newsletter --> admin_make_nls.php)
************************************************************************/

define("_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR","Es konnten keine Statistiken f&uuml;r die Anzahl der Benutzer ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS","Es konnten keine Statistiken f&uuml;r die Gesamtseitenzugriffe ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS","Es konnten keine Statistiken f&uuml;r die wartenden News ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT","Es konnten keine Statistiken f&uuml;r die Anzahl der News-Kategorien ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS","Es konnten keine Statistiken f&uuml;r Anzahl aller Downloads ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT","Es konnten keine Statistiken f&uuml;r die Anzahl der Download-Kategorien ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS","Es konnten keine Statistiken f&uuml;r Anzahl aller Web_Links ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT","Es konnten keine Statistiken f&uuml;r die Anzahl der Web_Links-Kategorien ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS","Es konnten keine Statistiken f&uuml;r Anzahl aller Foren ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS","Es konnten keine Statistiken f&uuml;r Anzahl aller Forenbeitr&auml;ge ausgelesen werden");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS","Es konnten keine Statistiken f&uuml;r Anzahl aller Testberichte ausgelesen werden");
define("_MSNL_ADM_SEND_ERR_DBGETNEWS","Aktuellster News-Artikel konnte nicht abgefragt werden");
define("_MSNL_ADM_MAKE_ERR_DBGETDLS","Aktuellster Download konnte nicht abgefragt werden");
define("_MSNL_ADM_MAKE_ERR_DBGETWLS","Aktuellster Web_Link konnte nicht abgefragt werden");
define("_MSNL_ADM_MAKE_ERR_DBGETPOSTS","Aktuellster Forumbeitrag konnte nicht abgefragt werden");
define("_MSNL_ADM_MAKE_ERR_DBGETREVIEWS","Aktuellster Testbericht konnte nicht abgefragt werden");
define("_MSNL_ADM_MAKE_ERR_DBGETBANNER","Banner konnte nicht abgefragt werden");

/************************************************************************
* Funktion: msnl_admin_send_tested  (Send Tested)
************************************************************************/

define("_MSNL_ADM_TEST_LAB_PREVNL","Vorschau eines getesteten Newsletter, um ihn zu senden");

/************************************************************************
* Funktion: msnl_cfg	(Haupt-Konfiguration Optionen)
************************************************************************/

define("_MSNL_CFG_LAB_MAINCFG","Hauptmodul Konfiguration");

//Modul Optionen
define("_MSNL_CFG_LAB_MODULEOPT","Modul Optionen");
define("_MSNL_CFG_LAB_DEBUGMODE","Debug Modus");
define("_MSNL_CFG_LAB_DEBUGMODE_OFF","OFF");
define("_MSNL_CFG_LAB_DEBUGMODE_ERR","ERROR");
define("_MSNL_CFG_LAB_DEBUGMODE_VER","VERBOSE");
define("_MSNL_CFG_LAB_DEBUGOUTPUT","Debug Output");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_DIS","DISPLAY");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_LOG","LOG FILE");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_BTH","BOTH");
define("_MSNL_CFG_LAB_SHOWBLOCKS","Zeige rechte Bl&ouml;cke");
define("_MSNL_CFG_LAB_NSNGRPS","Benutze NSN Groups (Zusatz-Addon)");
define("_MSNL_CFG_LAB_DLMODULE","Name der Download SQL Tabelle");
define("_MSNL_CFG_LAB_WYSIWYGON","Benutzer WYSIWYG Editor");
define("_MSNL_CFG_LAB_WYSIWYGROWS","Zeilen des Eingabefeldes");
define("_MSNL_CFG_HLP_DEBUGMODE","Diese Option bietet dem Admin folgende"
	." Error-Log Methoden:<br /><strong>OFF</strong> = Nur auf Modulebene - reine Modul-Mitteilungen, "
	."ohne Details werden angezeigt.<br /><strong>ERROR</strong> = Modulfehler "
	."werden zusammen mit n&uuml;tzlichen Debugger-Mitteilungen angezeigt. "
	."Ebenso werden SQL Fehler dargestellt.<br /> <strong>VERBOSE</strong> "
	."= Sehr detailierte Mitteilungen werden generiert. Es werden unter anderem Pfade angezeigt. "
	."Nutzen sie diese Option nicht zu lange, da auch Hacker dadurch n&uuml;tzliche "
	."Informationen ihres Servers auslesen k&ouml;nnen. <b>HINWEIS: Diese Option verschickt keine e-Mails!</b>"
	." - sehr n&uuml;tzlich bei der Fehlersuche."
	);
define("_MSNL_CFG_HLP_DEBUGOUTPUT","Diese Option wird noch nicht unterst&uuml;tzt. K&uuml;nftig soll man sich hierr&uuml;ber "
	."die Fehlermeldungen im Browser und/oder "
	." als Logdatei ausgeben zu lassen"
	);
define("_MSNL_CFG_HLP_SHOWBLOCKS","Wenn <strong>aktiv</strong> werden die rechten"
	." Bl&ouml;cke dargestellt. Wenn <strong>inaktiv</strong> werden die rechten"
	." Bl&ouml;cke nicht angezeigt.  Der Standardwert ist <strong>inaktiv</strong>."
	);
define("_MSNL_CFG_HLP_NSNGRPS","Diese Option ist nur von nutzen wenn sie das Zusatz-Addon "
	."\"NSN Groups\" installiert haben. Download z.B. bei www.Warp-Speed.de. Wenn sie den Newsletter zu einer oder mehreren NSN Gruppen "
	."schicken wollen, aktivieren sie diese Option."
	);
define("_MSNL_CFG_HLP_DLMODULE","Tragen sie hier die Endung ihrer Download-SQL "
	."Tabelle ein. Standardwert ist 'downloads' von nuke_"
	."<strong>downloads</strong>_downloads. Bei NSN Groups w&auml;re es 'nsngd' "
	."von nuke_<strong>nsngd</strong>_downloads."
	);
define("_MSNL_CFG_HLP_WYSIWYGON","Aktivieren sie diese Option falls sie einen WYSIWYG- "
	."Editor f&uuml;r den Newsletter Textbereich (textbody) einsetzen wollen. <strong>HINWEIS:</strong> Diese "
	."Option erfordert, dass das Zusatz-Addon \"nukeWYSIWYG\" installiert ist. Download z.B. bei www.Warp-Speed.de"
	);
define("_MSNL_CFG_HLP_WYSIWYGROWS","Legt die Anzahl der Zeilen des Eingabefeldes (textbody) auf "
	." der \"Erstelle Newsletter\" Seite fest. "
	."Funktioniert mit oder ohne WYSIWYG Editor."
	);

//Darstellungs Optionen
define("_MSNL_CFG_LAB_SHOWOPT","Zeige Optionen");
define("_MSNL_CFG_LAB_SHOWCATS","Zeige Kategorien");
define("_MSNL_CFG_LAB_SHOWHITS","Zeige Aufrufe");
define("_MSNL_CFG_LAB_SHOWDATES","Zeige verschickt am");
define("_MSNL_CFG_LAB_SHOWSENDER","Zeige Sender");
define("_MSNL_CFG_HLP_SHOWCATS","Wenn aktiv, werden die Newsletter im Block mit ihrer "
	."dazugeh&ouml;rigen Kategorie dargestellt. Kategorien werden im Archiv "
	."(Modul) immer mit angezeigt."
	);
define("_MSNL_CFG_HLP_SHOWHITS","Wenn aktiv, werden die Aufrufe der Newsletter "
	."im Block oder Modul mit dargestellt."
	);
define("_MSNL_CFG_HLP_SHOWDATES","Wenn aktiv, wird das Absendedatum der Newsletter "
	."im Block oder Modul mit dargestellt."
	);
define("_MSNL_CFG_HLP_SHOWSENDER","Wenn aktiv, wird der Absender der Newsletter "
	."im Block oder Modul mit dargestellt."
	);

//Block Optionen
define("_MSNL_CFG_LAB_BLKOPT","Block Optionen");
define("_MSNL_CFG_LAB_BLKLMT","Anzahl der Newsletters im Block");
define("_MSNL_CFG_LAB_SCROLL","Scrollenden Blockcode");
define("_MSNL_CFG_LAB_SCROLLHEIGHT","Scrollcode H&ouml;he");
define("_MSNL_CFG_LAB_SCROLLAMT","Scroll Geschwindigkeit");
define("_MSNL_CFG_LAB_SCROLLDELAY","Scroll Verz&ouml;gerung");
define("_MSNL_CFG_HLP_BLKLMT","Regelt die GESAMT Anzahl an Newslettern "
	."die im Block dargestellt "
	."werden."
	);
define("_MSNL_CFG_HLP_SCROLL","Dieses Feature atkiviert das "
	."aufw&auml;rts scrollen des Blockinhalts."
	);
define("_MSNL_CFG_HLP_SCROLLHEIGHT","Gibt die H&ouml;he des Scrollbereichs in Pixel an, "
	."Standard ist 180. Beachten sie, dass ein zu kleiner Wert sie evtl. nichts sehen lassen wird."
	);
define("_MSNL_CFG_HLP_SCROLLAMT","Legt die Scrollgeschwindigkeit fest. "
	."Dies ist die Geschwindigkeit mit welcher die dargestellten Informationen durchscrollen. "
	."Standard ist 2."
	);
define("_MSNL_CFG_HLP_SCROLLDELAY","Legt die Verz&ouml;gerung zwischen den Scrolldurchl&auml;ufen fest. "
	."Der Wert wird in mil-sek angegeben. Standard ist 100."
	);

/************************************************************************
* Funktion: msnl_cfg_apply	(Änderungen übernehmen, zur Hauptkonfiguration)
************************************************************************/

define("_MSNL_CFG_APPLY_ERR_DBFAILED","Das updaten der Konfigurations-Informationen schlug fehl");
define("_MSNL_CFG_APPLY_VAL_DEBUGMODE","Es wurde ein falscher Debug-Modus &uuml;bergeben - kann an "
	."einem Problem mit der Modulinstallation liegen"
	);
define("_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT","Es wurde ein falscher Debug-Ausgabe-Modus &uuml;bergeben - kann an "
	."einem Problem mit der Modulinstallation liegen"
	);
define("_MSNL_CFG_APPLY_MSG_BACK","Zur&uuml;ck zur Haupt-Konfiguration");

/************************************************************************
* Funktion: msnl_cat	(Verwalte Newsletter Kategorien)
************************************************************************/

define("_MSNL_CAT_LAB_CATCFG","Newsletter Kategorien Konfiguration");
define("_MSNL_CAT_LAB_ADDCAT","Kategorie zuf&uuml;gen");
define("_MSNL_CAT_LAB_CATTITLE","Kategorie Titel");
define("_MSNL_CAT_LAB_CATDESC","Kategorie Beschreibung");
define("_MSNL_CAT_LAB_CATBLOCKLMT","Block Limit");
define("_MSNL_CAT_LNK_ADDCAT","Zuf&uuml;gen einer neuen Kategorie");
define("_MSNL_CAT_LNK_CATCHG","Editieren von Kategorien");
define("_MSNL_CAT_LNK_CATDEL","L&ouml;schen von Kategorien");
define("_MSNL_CAT_MSG_CATBACK","Zur&uuml;ck zur Newsletter-Kategorien &Uuml;bersicht");
define("_MSNL_CAT_ERR_DBGETCAT","Das auslesen der Newsletter-Kategorien schlug fehl");
define("_MSNL_CAT_ERR_DBGETCATS","Konnte Newsletter-Kategorien nicht finden");
define("_MSNL_CAT_ERR_NOCATS","Keine Kategorien gefunden - Schwere Probleme mit der Installation");
define("_MSNL_CAT_ERR_INVALIDCID","Falsche Newsletter-Kategorien ID wurde &uuml;bermittelt");
define("_MSNL_CAT_ERR_DBGETCNT","Fehler beim auslesen der Anzahl der zugestellten Newsletter");
define("_MSNL_CAT_HLP_CATTITLE","Dieses Feld legt den Namen der Kategorie fest die sowohl im "
	."Block (falls aktiviert), als auch im Newsletter Archive dargestellt "
	."wird. Da dies auch die &Uuml;berschrift im Block ist, sollte die Anzahl der Zeichen in diesem "
	."Feld den Wert von 30 nicht &uuml;berschreiten, damit der Block korrekt angezeigt "
	."werden kann."
	);
define("_MSNL_CAT_HLP_CATDESC","Dies ist ein sehr großes Feld. Es gibt nur die eine Einschr&auml;nkung, "
	."dass in ihm keine HTML Tags genutzt werden d&uuml;rfen. Sie k&ouml;nnen zwar welche nutzen, diese werden aber "
	."sp&auml;ter automatisch rausgefiltert. Nutzen sie eine klare und aussagekr&auml;ftige Beschreibung f&uuml;r Kategorien."
	);
define("_MSNL_CAT_HLP_CATBLOCKLMT","Dieses Feld wird nur bei aktiv sein der <b>Zeige Kategorien</b> "
	."Option genutzt und muss gr&ouml;ßer als 0 (null) sein.  Geben sie hier den Wert ein, "
	."der die Anzahl der darzustellenden Newsletter in dieser Kategorie "
	."f&uuml;r die Anzeige im Block festlegt. Keine Angabe setzt eine "
	);

/************************************************************************
* Funktion: msnl_cat_add
************************************************************************/

define("_MSNL_CAT_ADD_LAB_CATADD","Newsletter Kategorien Konfiguration - Kategorie zuf&uuml;gen");

/************************************************************************
* Funktion: msnl_cat_add_apply
************************************************************************/

define("_MSNL_CAT_ADD_APPLY_DBCATADD","Das zuf&uuml;gen der Newsletter Kategorie schlug fehl");

/************************************************************************
* Funktion: msnl_cat_chg
************************************************************************/

define("_MSNL_CAT_CHG_LAB_CATCHG","Newsletter Kategorien Konfiguration - Editiere Kategorie");
define("_MSNL_CAT_CHG_MSG_CHGIMPACT","Newsletter sind von diesen &Auml;nderungen betroffen");

/************************************************************************
* Funktion: msnl_cat_chg_apply
************************************************************************/

define("_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG","Das updaten der Newsletter Kategorie schlug fehl");

/************************************************************************
* Funktion: msnl_cat_del
************************************************************************/

define("_MSNL_CAT_DEL_MSG_DELIMPACT","Newsletter sind von der L&ouml;schung betroffen.");
define("_MSNL_CAT_DEL_MSG_DELIMPACT1","Betroffene Newsletter werden der Standard \"unzugewiesenen Kategorie\" zugeordnet. "
	."Wollen sie den L&ouml;schvorgang ausf&uuml;hren?"
	);

/************************************************************************
* Funktion: msnl_cat_del_apply
************************************************************************/

define("_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN","Neuzuweisung des Newsletters schlug fehl");
define("_MSNL_CAT_DEL_APPLY_ERR_DBDELETE","L&ouml;schen der Newsletter-Kategorie schlug fehl");

/************************************************************************
* Funktion: msnl_nls
************************************************************************/

define("_MSNL_NLS_LAB_NLSCFG","Verwalte Newsletter");
define("_MSNL_NLS_LAB_CURRENTCAT","Derzeitige Kategorie");
define("_MSNL_NLS_LAB_DATESENT","Absendedatum");
define("_MSNL_NLS_LAB_CATEGORY","Kategorie");
define("_MSNL_NLS_LNK_GETNLS","Angeforderte Newsletter einsehen");
define("_MSNL_NLS_LNK_VIEWNL","Zeige Newsletter - &ouml;ffnet evtl. ein neues Fenster");
define("_MSNL_NLS_LNK_NLSCHG","Editiere Newsletter Information");
define("_MSNL_NLS_LNK_NLSDEL","L&ouml;sche Newsletter");
define("_MSNL_NLS_MSG_NONLSS","Keine Newsletter in dieser Kategorie gefunden");
define("_MSNL_NLS_MSG_NLSBACK","Zur&uuml;ck zur Newsletter &Uuml;bersicht");
define("_MSNL_NLS_ERR_DBGETNLSS","Newsletter nicht gefunden");
define("_MSNL_NLS_ERR_DBGETNLS","Fehler beim lesen der Newsletter Information");
define("_MSNL_NLS_ERR_INVALIDNID","Es wurde eine falsche Newsletter ID &uuml;bermittelt");
define("_MSNL_NLS_ERR_NONLSS","Keine Newsletter gefunden - Schwere Probleme mit der Installation");

/************************************************************************
* Funktion: msnl_nls_chg
************************************************************************/

define("_MSNL_NLS_CHG_LAB_NLSCHG","Verwalte Newsletter - Editiere Newsletter Information");
define("_MSNL_NLS_CHG_LAB_DATESENT","Absendedatum");
define("_MSNL_NLS_CHG_LAB_WHOVIEW","Wer kann Newsletter einsehen");
define("_MSNL_NLS_CHG_LAB_NSNGRPS","NSN Groups k&ouml;nnen Newsletter einsehen");
define("_MSNL_NLS_CHG_LAB_NBRHITS","Anzahl der Aufrufe");
define("_MSNL_NLS_CHG_LAB_FILENAME","Newsletter Dateiname");
define("_MSNL_NLS_CHG_LAB_CAUTION","&Auml;nderen sie die folgenden Werte nur wenn sie wissen was sie tun");
define("_MSNL_NLS_CHG_HLP_DATESENT","Derzeit muss das Format (YYYY-MM-DD) wie im Feld "
	."dargestellt eingegeben werden. Wenn der Newsletter zuerst erstellt und dann verschickt wurde, "
	."wird das Feld mit der derzeitigen Systemzeit ausgef&uuml;llt. Newsletter werden immer in chronologischer "
	." Anzeige dargestellt. Die neusten erscheinen als erstes auf der Liste."
	);
define("_MSNL_NLS_CHG_HLP_WHOVIEW","Dies ist ein Systemfeld - seien sie vorsichtig "
	."wenn sie Werte ver&auml;ndern!  G&uuml;ltige Werte sind:"
	."<br /><strong>0</strong> = Anonym - F&uuml;r alle einsehbar"
	."<br /><strong>1</strong> = Angemeldete Benutzer"
	."<br /><strong>2</strong> = Bezahlende (Subscribers) Benutzer"
	."<br /><strong>3</strong> = Seiten-Sponsoren"
	."<br /><strong>4</strong> = Ausgew&auml;hlte NSN Gruppen"
	."<br /><strong>5</strong> = Ad-Hoc e-Mail Adressen"
	."<br /><strong>99</strong> = Seiten-Administrator"
	);
define("_MSNL_NLS_CHG_HLP_NSNGRPS","Als Vorraussetzung muss die obige <b>Berechtigungs</b> Option "
	."auf 4 (Ausgew&auml;hlte NSN Gruppen) gesetzt sein. Jede NSN Gruppe hat eine eindeutige zugewiesene ID. "
	."Bei der Erstellung des Newsletters k&ouml;nnen eine oder mehrere NSN Gruppen zum Empfang "
	."gew&auml;hlt werden. F&uuml;r nur eine NSN Gruppe muss nur die zugeh&ouml;rige Gruppen ID angegeben werden. "
	."Bei mehr als einer NSN Gruppe, m&uuml;ssen die Gruppen durch einen \"Gedankenstrich\" getrennt werden. Beispiel: <b>1-2-3</b>."
	);
define("_MSNL_NLS_CHG_HLP_NBRHITS","Wenn ein Newsletter von einem Link im Block oder im Archiv "
	."aufgerufen wird, steigt der Z&auml;hler (Aufrufe). Der Z&auml;hler steigt nicht, wenn der Administrator"
	."der Seite auf die Newsletter zugreift."
	);
define("_MSNL_NLS_CHG_HLP_FILENAME","Dies ist ein Systemfeld. Sollten sie es &auml;ndern, "
	."stellen sie sicher, dass es die Datei gibt und das sie richtig formatiert ist."
	);

/************************************************************************
* Funktion: msnl_nls_chg_apply
************************************************************************/

define("_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW","Wert muss 0 - 4 sein, oder 99");
define("_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG","Das updaten der Newsletter Information schlug fehl");

/************************************************************************
* Funktion: msnl_nls_del
************************************************************************/

define("_MSNL_NLS_DEL_MSG_DELIMPACT","Sie sind dabei den Newsletter f&uuml;r immer zu l&ouml;schen.");
define("_MSNL_NLS_DEL_MSG_DELIMPACT1","Alle Informationen bez&uuml;glich des Newsletters werden "
	."aus der Datenbank und aus dem Archiv gel&ouml;scht. "
	."Wollen sie den L&ouml;schvorgang wirklich fortsetzen?"
	);

/************************************************************************
* Funktion: msnl_nls_del_apply
************************************************************************/

define("_MSNL_NLS_DEL_APPLY_ERR_FILEDEL","Konnte Newsletterdatei nicht l&ouml;schen - &Uuml;berpr&uuml;fen "
	."sie die Dateiberechtigung"
	);
define("_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL","Das l&ouml;schen der Newsletter Information schlug fehl");

?>