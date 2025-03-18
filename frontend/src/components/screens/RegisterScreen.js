import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity } from 'react-native';
import styles from '../../styles/RegisterStyles';

const RegisterScreen = ({ navigation }) => {
  const [firstname, setFirstname] = useState('');
  const [lastname, setLastname] = useState('');
  const [email, setEmail] = useState('');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');

  return (
    <View style={styles.container}>

      {/* Boutons de connexion sociale */}
      <TouchableOpacity style={[styles.socialButton, styles.googleButton]}>
        <Text style={styles.socialButtonText}>Sign in with Google</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.socialButton, styles.facebookButton]}>
        <Text style={styles.socialButtonText}>Sign in with Facebook</Text>
      </TouchableOpacity>

      {/* Séparateur */}
      <View style={styles.separatorContainer}>
        <View style={styles.separator} />
        <Text style={styles.separatorText}>OU</Text>
        <View style={styles.separator} />
      </View>

      {/* Formulaire d'inscription */}
      <Text style={styles.label}>Prénom</Text>
      <TextInput
        value={firstname}
        onChangeText={setFirstname}
        style={styles.input}
      />

      <Text style={styles.label}>Nom de famille</Text>
      <TextInput
        value={lastname}
        onChangeText={setLastname}
        style={styles.input}
      />

      <Text style={styles.label}>Email</Text>
      <TextInput
        value={email}
        onChangeText={setEmail}
        style={styles.input}
      />

      <Text style={styles.label}>Pseudo</Text>
      <TextInput
        value={username}
        onChangeText={setUsername}
        style={styles.input}
      />

      <Text style={styles.label}>Mot de passe</Text>
      <TextInput
        value={password}
        onChangeText={setPassword}
        secureTextEntry
        style={styles.input}
      />

      <Text style={styles.label}>Confirmer le mot de passe</Text>
      <TextInput
        value={confirmPassword}
        onChangeText={setConfirmPassword}
        secureTextEntry
        style={styles.input}
      />

      {/* Bouton d'inscription */}
      <TouchableOpacity style={styles.button} onPress={() => console.log("Inscription...")}>
        <Text style={styles.buttonText}>S'inscrire</Text>
      </TouchableOpacity>

      {/* Lien de connexion */}
      <TouchableOpacity onPress={() => navigation.navigate("Login")}>
        <Text style={styles.link}>Déjà un compte ? Connecte-toi</Text>
      </TouchableOpacity>
    </View>
  );
};

export default RegisterScreen;
