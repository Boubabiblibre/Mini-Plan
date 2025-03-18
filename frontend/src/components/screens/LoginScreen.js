import React, { useState } from 'react';
import { View, TextInput, TouchableOpacity, Text } from 'react-native';
import { Button } from 'react-native-paper';
import { useNavigation } from '@react-navigation/native';
import LoginStyles from '../../styles/LoginStyles';

const LoginScreen = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const navigation = useNavigation(); // Ajout de useNavigation

  return (
    <View style={LoginStyles.container}>
      <Text style={LoginStyles.label}>Email</Text>
      <TextInput
        value={username}
        onChangeText={setUsername}
        style={LoginStyles.input}
      />

      <Text style={LoginStyles.label}>Mot de passe</Text>
      <TextInput
        value={password}
        onChangeText={setPassword}
        secureTextEntry
        style={LoginStyles.input}
      />

      <Button
        mode="contained"
        onPress={() => console.log('Connexion...')}
        style={LoginStyles.button}
        labelStyle={LoginStyles.buttonText}
      >
        Se connecter
      </Button>

      <TouchableOpacity onPress={() => navigation.navigate("Register")}>
        <Text style={LoginStyles.link}>Pas encore inscrit ? Inscris-toi</Text>
      </TouchableOpacity>
    </View>
  );
};

export default LoginScreen;
