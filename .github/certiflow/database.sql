CREATE DATABASE IF NOT EXISTS certiflow;
USE certiflow;

-- USERS TABLE

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TEMPLATES TABLE

CREATE TABLE templates (
    id INT AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    category ENUM(
        'Professional',
        'Kids',
        'School',
        'Events',
        'Internship',
        'Workshop',
        'Hackathon',
        'Sports',
        'Creative',
        'Birthday'
    ) NOT NULL,

    description TEXT,

    preview_image VARCHAR(255) NOT NULL,

    is_default TINYINT(1) DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CERTIFICATES TABLE

CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,

    template_id INT NOT NULL,

    recipient_name VARCHAR(255) NOT NULL,

    certificate_title VARCHAR(255) NOT NULL,

    issued_by VARCHAR(255),

    issue_date DATE,

    certificate_file VARCHAR(255),

    verification_code VARCHAR(100) UNIQUE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (template_id)
    REFERENCES templates(id)
    ON DELETE CASCADE
);

-- SAMPLE DEFAULT TEMPLATES

INSERT INTO templates
(title, category, description, preview_image, is_default)
VALUES
('Attendance Award', 'Kids', 'Student attendance certificate', 'uploads/templates/kids/attendance_award.jpg', 1),

('Best Student', 'Kids', 'Best student achievement certificate', 'uploads/templates/kids/best_student.jpg', 1),

('Little Artist', 'Kids', 'Creative art participation certificate', 'uploads/templates/kids/little_artist.jpg', 1),

('Employee Excellence', 'Professional', 'Outstanding employee performance certificate', 'uploads/templates/professional/Employee_Excellence.jpg', 1),

('Leader Achievement', 'Professional', 'Leadership achievement certificate', 'uploads/templates/professional/Leader_Achievement.jpg', 1),

('Sports Excellence', 'Sports', 'Sports excellence recognition certificate', 'uploads/templates/sports/sports_excellence.jpg', 1),

('Appreciation Award', 'Professional', 'Appreciation certificate', 'uploads/templates/professional/appreciation_award.jpg', 1),

('Event Organizer', 'Events', 'Event organizer recognition certificate', 'uploads/templates/events/event_organizer.jpg', 1),

('Volunteer Certificate', 'Events', 'Volunteer participation certificate', 'uploads/templates/events/volunteer_certificate.jpg', 1),

('Reading Champion', 'Kids', 'Reading champion certificate', 'uploads/templates/kids/reading_champion.jpg', 1),

('Star Performer', 'Kids', 'Star performer recognition certificate', 'uploads/templates/kids/star_performer.jpg', 1),

('Young Scientist', 'Kids', 'Young scientist recognition certificate', 'uploads/templates/kids/young_scientist.jpg', 1);

('Running Winner', 'Sports', 'Running achievement certificate', 'uploads/templates/sports/running_winner.jpg', 1);

('Winner' , 'Sports', 'Winner recognition certificate', 'uploads/templates/sports/winner_certificate.jpg', 1);

SELECT id,title,category,preview_image
FROM templates;
