DROP TABLE toa.scriptures;
DROP SCHEMA toa;

CREATE SCHEMA toa;

CREATE TABLE toa.scriptures
(scripture_id SERIAL PRIMARY KEY,
 book VARCHAR(100) NOT NULL,
 chapter INT NOT NULL,
 verse INT NOT NULL,
 content TEXT NOT NULL
);

INSERT INTO toa.scriptures (book, chapter, verse, content)
VALUES
('John',
 1,
 5,
 'For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.'
);

INSERT INTO toa.scriptures (book, chapter, verse, content)
VALUES
('Doctrine and Covenants',
 88,
 49,
 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'
);

INSERT INTO toa.scriptures (book, chapter, verse, content)
VALUES
('Doctrine and Covenants',
 93,
 28,
 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'
);

INSERT INTO toa.scriptures (book, chapter, verse, content)
VALUES
('Mosiah',
 16,
 9,
 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.'
);