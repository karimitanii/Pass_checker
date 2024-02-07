import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
import numpy as np

import warnings

warnings.filterwarnings("ignore", category=DeprecationWarning)
warnings.filterwarnings("ignore", category=FutureWarning)


#data to train the model
passwords = [
    "karim123", "123456", "Jad_itani-9742", "ibrahim_67264_lau", "#321lau_karim_764",
    "jadlau", "bob123", "highly_secretive_009", "unbreakable@password@491", "fortress#456","weak","ki123","karim_halabi@54212_42#21","jad@321_421","karim?2041_2","koko?146","lol123"
]

labels = np.array([0, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0,1,1,1,1,0])

tokenizer = Tokenizer(char_level=True)
tokenizer.fit_on_texts(passwords)
sequences = tokenizer.texts_to_sequences(passwords)

padded_sequences = pad_sequences(sequences)

model = tf.keras.Sequential([
    tf.keras.layers.Embedding(input_dim=len(tokenizer.word_index) + 1, output_dim=8, input_length=padded_sequences.shape[1]),
    tf.keras.layers.Flatten(),
    tf.keras.layers.Dense(16, activation='relu'),
    tf.keras.layers.Dense(1, activation='sigmoid')
])

model.compile(optimizer='adam', loss='binary_crossentropy', metrics=['accuracy'])

model.fit(padded_sequences, labels, epochs=100)

def check_password_strength(password):
    sequence = tokenizer.texts_to_sequences([password])
    padded_sequence = pad_sequences(sequence, maxlen=padded_sequences.shape[1])
    prediction = model.predict(padded_sequence)
    return "Strong" if prediction[0][0] >= 0.5 else "Weak"

if __name__ == "__main__":
    import sys
    password = sys.argv[1]

    result = check_password_strength(password)
    print(result)
