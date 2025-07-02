CREATE TABLE votes(
id INT AUTO_INCREMENT PRIMARY KEY ,
candidate_id INT,
user_id INT,
election_id INT,
voted_at DATETIME DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (candidate_id) REFERENCES candidates(id),
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (election_id) REFERENCES elections(id)
);