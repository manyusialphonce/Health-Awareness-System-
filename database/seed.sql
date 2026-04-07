-- ======================================
-- Database: health_awareness_system
-- ======================================

CREATE DATABASE health_awareness_system;
USE health_awareness_system;

-- ======================================
-- Table: messages
-- ======================================
DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample messages
INSERT INTO messages (name, email, message) VALUES
('Asimwe Alphonce', 'asimwe@example.com', 'Nina dalili ya homa na kikohozi.'),
('Mary John', 'mary@example.com', 'Nina maumivu ya kichwa na mwili.'),
('David Mwangi', 'david@example.com', 'Nina kuchanganyikiwa na kuumwa na tumbo.');

-- ======================================
-- Table: diseases
-- ======================================
DROP TABLE IF EXISTS diseases;
CREATE TABLE diseases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    prevention TEXT,
    advice TEXT
);

-- Sample diseases
INSERT INTO diseases (name, prevention, advice) VALUES
('Malaria', 'Tumia neti za kuzuia mbu, chumvi na dawa za prophylaxis.', 'Pata dawa mapema unapoona dalili za homa na baridi.'),
('Common Cold', 'Osha mikono mara kwa mara, kuepuka kugusana na wagonjwa.', 'Pumua kwa usingizi, kunywa maji mengi, na epuka baridi.'),
('Diabetes', 'Kula chakula chenye afya, fanya mazoezi mara kwa mara.', 'Angalia sukari ya damu mara kwa mara na fuata ushauri wa daktari.');

-- ======================================
-- Table: symptoms
-- ======================================
DROP TABLE IF EXISTS symptoms;
CREATE TABLE symptoms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Sample symptoms
INSERT INTO symptoms (name) VALUES
('Homa'), 
('Kikohozi'), 
('Maumivu ya kichwa'), 
('Maumivu ya mwili'), 
('Kuchanganyikiwa'), 
('Maumivu ya tumbo'), 
('Kuchoka'), 
('Kukosa hamu ya kula'), 
('Baridi'), 
('Joto la mwili');

-- Table: disease_symptoms
DROP TABLE IF EXISTS disease_symptoms;
CREATE TABLE disease_symptoms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT NOT NULL,
    symptom_id INT NOT NULL,
    FOREIGN KEY (disease_id) REFERENCES diseases(id) ON DELETE CASCADE,
    FOREIGN KEY (symptom_id) REFERENCES symptoms(id) ON DELETE CASCADE
);

-- Sample mapping
INSERT INTO disease_symptoms (disease_id, symptom_id) VALUES
(1, 1), -- Malaria → Homa
(1, 2), -- Malaria → Kikohozi
(1, 10), -- Malaria → Joto la mwili
(2, 2), -- Common Cold → Kikohozi
(2, 3), -- Common Cold → Maumivu ya kichwa
(2, 5), -- Common Cold → Kuchanganyikiwa
(3, 7), -- Diabetes → Kuchoka
(3, 8), -- Diabetes → Kukosa hamu ya kula
(3, 9); -- Diabetes → Baridi



INSERT INTO diseases (name, meaning, prevention, advice, symptoms) VALUES (
    'Kaswende (Syphilis)',
    'Kaswende (Syphilis) ni ugonjwa wa zinaa unaosababishwa na bakteria, na unaweza kuzuilika kwa kuchukua tahadhari sahihi.',
    '1. Tumia kondomu kila wakati 🛡️
2. Kuwa na mpenzi mmoja mwaminifu
3. Pima afya mara kwa mara 🧪
4. Epuka ngono zembe (zembe bila kinga)
5. Angalia dalili mapema
6. Epuka kushiriki vifaa vya ngono
7. Elimu ya afya ya uzazi',
    '🔑 1. Linda afya yako kwanza
🛡️ 2. Kondomu isiwe option, iwe lazima
❤️ 3. Chagua uhusiano salama
🧪 4. Pima hata kama unaonekana mzima
⚠️ 5. Usipuuze dalili ndogo
💬 6. Kuwa mkweli kwenye mahusiano
🚫 7. Epuka pombe kupita kiasi kabla ya ngono',
    'Kidonda kisicho na maumivu sehemu za siri, mdomoni au sehemu nyingine,
Upele mwilini (hasa mikono na miguu – viganja na nyayo),
Homa ndogo,
Maumivu ya kichwa,
Uchovu mwingi / mwili kukosa nguvu,
Kuvimba kwa tezi (lymph nodes),
Vidonda mdomoni au sehemu za siri,
Kupoteza nywele (patchy hair loss),
Maumivu ya misuli,
Kupungua uzito bila sababu,
Kukosa hamu ya kula'
);


INSERT INTO disease_symptoms (disease_id, symptom_id) VALUES
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30);




-- Reminder system
CREATE TABLE IF NOT EXISTS reminders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    reminder_date DATETIME,
    is_done TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Hospital locator
CREATE TABLE IF NOT EXISTS hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    address VARCHAR(255),
    latitude DECIMAL(10,7),
    longitude DECIMAL(10,7),
    contact VARCHAR(50)
);

-- Chat / Q&A system
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    question TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT,
    answer TEXT,
    admin_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Advanced health tips
CREATE TABLE IF NOT EXISTS health_tips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT, -- optional
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS health_tips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    disease_id INT DEFAULT NULL, -- optional, link to diseases table
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);