import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  SafeAreaView,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons'; // ou 'react-native-vector-icons/Ionicons'
import styles from '../../styles/AddSubscriptionStyles';

const AddSubscriptionScreen = () => {
  // États pour chaque champ
  const [firstName, setFirstName] = useState('');
  const [lastName, setLastName] = useState('');
  const [pseudo, setPseudo] = useState('');
  const [email, setEmail] = useState('');
  const [phoneNumber, setPhoneNumber] = useState('');
  const [birth, setBirth] = useState('');
  const [gender, setGender] = useState('');

  const handleUpdate = () => {
    // Logique de validation ou d’envoi de données (API) 
    console.log('AddSubscription form submitted!');
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Header */}
      <View style={styles.header}>
        <TouchableOpacity
          style={styles.backButton}
          onPress={() => navigation?.goBack?.()}
        >
          <Ionicons name="arrow-back" size={24} color="#fff" />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>Edit profile</Text>
        {/* 
          Si tu veux vraiment “Add Subscription”, remplace le texte ci-dessus par :
          <Text style={styles.headerTitle}>Add Subscription</Text>
        */}
      </View>

      {/* Formulaire */}
      <View style={styles.formContainer}>
        <Text style={styles.label}>First Name</Text>
        <TextInput
          style={styles.input}
          placeholder="Enter your first name"
          placeholderTextColor="#000"
          value={firstName}
          onChangeText={setFirstName}
        />

        <Text style={styles.label}>Last Name</Text>
        <TextInput
          style={styles.input}
          placeholder="Enter your last name"
          placeholderTextColor="#000"
          value={lastName}
          onChangeText={setLastName}
        />

        <Text style={styles.label}>Pseudo</Text>
        <TextInput
          style={styles.input}
          placeholder="Enter your pseudo"
          placeholderTextColor="#000"
          value={pseudo}
          onChangeText={setPseudo}
        />

        <Text style={styles.label}>Email</Text>
        <TextInput
          style={styles.input}
          placeholder="Enter your email"
          placeholderTextColor="#000"
          value={email}
          onChangeText={setEmail}
          keyboardType="email-address"
        />

        <Text style={styles.label}>Phone Number</Text>
        <View style={styles.inputWithIcon}>
          <TextInput
            style={[styles.input, { flex: 1 }]}
            placeholder="Enter phone number"
            placeholderTextColor="#000"
            value={phoneNumber}
            onChangeText={setPhoneNumber}
            keyboardType="phone-pad"
          />
          <Ionicons
            name="chevron-down"
            size={24}
            color="#000"
            style={{ marginRight: 10 }}
          />
        </View>

        <Text style={styles.label}>Birth</Text>
        <View style={styles.inputWithIcon}>
          <TextInput
            style={[styles.input, { flex: 1 }]}
            placeholder="Select birth date"
            placeholderTextColor="#000"
            value={birth}
            onChangeText={setBirth}
          />
          <Ionicons
            name="chevron-down"
            size={24}
            color="#000"
            style={{ marginRight: 10 }}
          />
        </View>

        <Text style={styles.label}>Gender</Text>
        <View style={styles.inputWithIcon}>
          <TextInput
            style={[styles.input, { flex: 1 }]}
            placeholder="Select gender"
            placeholderTextColor="#000"
            value={gender}
            onChangeText={setGender}
          />
          <Ionicons
            name="chevron-down"
            size={24}
            color="#000"
            style={{ marginRight: 10 }}
          />
        </View>

        {/* Bouton d'action */}
        <TouchableOpacity style={styles.button} onPress={handleUpdate}>
          <Text style={styles.buttonText}>UPDATE</Text>
          {/*
            Ou “SAVE”, “ADD” etc. :
            <Text style={styles.buttonText}>ADD</Text>
          */}
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

export default AddSubscriptionScreen;
