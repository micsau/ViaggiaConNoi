# ViaggiaConNoi
Progetto per la Maturità 2019/2020

#DESCRIZIONE DEL PROGETTO

Sito Web per poter acquistare in completa sicurezza il tuo prossimo viaggio nella destinazione da te voluta.

# FEATURE

disponibilità di numerosi viaggi da cui scegliere.

visualizzare nella mappa il punto esatto dove si è diretti.

visualizzare sulla mappa la tua posizione esatta.

acquistare il biglietto in modo sicuro tramite Stripe.

possibilità di poter inviare una mail al creatore del sito per eventuali bug trovati.

# REGISTRAZIONE

L'utente è OBBLIGATO a registrarsi per poter acquistare il biglietto; ma non c'é bisogno di registrazione per poter visualizzare le offerte attive.

# DATI RICHIESTI

Nome, Cognome, Data di Nascita, Luogo di Nascita, Username, Password, Immagine del Profilo.

l'immagine del profilo una volta inserita non si può cambiare, quindi ATTENZIONE a ciò che inserite!
 
# SCHEMA LOGICO (Per i più curiosi)

Acquisti (data, id_user_fk, id_dest_fk).

Destinazioni (id, citta, prezzo, notti, descrizione, latitudine, longitudine, isBought, quantità, id_user_fk).

Immagini (id, url, id_dest_fk).

Profilepics (id, url).

Users (id, username, password, role, nome, cognome, data_nascita, luogo_nascita, email, id_profilepic_fk).

# UPGRADE ANCORA SOTTO SVILUPPO
- la possibilità di poter cambiare la propria foto profilo all'interno della sezione profilo.
