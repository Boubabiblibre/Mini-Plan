import React, { useState } from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  TextInput,
  SafeAreaView,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons'; // Assurez-vous d'avoir installé react-native-vector-icons
import styles from './CustomSubscriptionStyles';

const CustomSubscriptionScreen = () => {
  // États pour chaque champ
  const [name, setName] = useState('');
  const [cycle, setCycle] = useState('Monthly');
  const [startDate, setStartDate] = useState('');
  const [paymentMethod, setPaymentMethod] = useState('');
  const [remindMe, setRemindMe] = useState('Never');

  // Fonctions pour simuler la sélection dans cet exemple
  const selectCycle = () => {
    // Ouvrir un modal, un Picker, etc.
    setCycle(cycle === 'Monthly' ? 'Yearly' : 'Monthly');
  };

  const selectDate = () => {
    // Ouvrir un date picker
    setStartDate('2025-03-15'); // Par exemple
  };

  const selectPaymentMethod = () => {
    // Ouvrir un modal ou un Picker
    setPaymentMethod(paymentMethod === 'Paypal' ? 'Visa' : 'Paypal');
  };

  const selectRemindMe = () => {
    // Ouvrir un modal ou un Picker
    setRemindMe(remindMe === 'Never' ? 'Every month' : 'Never');
  };

  const handleAdd = () => {
    // Logique d’ajout (envoi vers API, validations, etc.)
    console.log('Custom subscription added:', {
      name,
      cycle,
      startDate,
      paymentMethod,
      remindMe,
    });
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Header avec flèche pour revenir en arrière */}
      <View style={styles.header}>
        <TouchableOpacity
          style={styles.backButton}
          onPress={() => navigation?.goBack?.()}
        >
          <Ionicons name="arrow-back" size={24} color="#72CE1D" />
        </TouchableOpacity>
      </View>

      {/* Formulaire */}
      <View style={styles.formContainer}>

        {/* Name */}
        <Text style={styles.label}>Name</Text>
        <TextInput
          style={styles.input}
          placeholder="Enter subscription name"
          placeholderTextColor="#72CE1D"
          value={name}
          onChangeText={setName}
        />

        {/* Cycle */}
        <Text style={styles.label}>Cycle</Text>
        <TouchableOpacity style={styles.inputRow} onPress={selectCycle}>
          <Text style={styles.valueText}>{cycle || 'Monthly'}</Text>
          <Ionicons name="chevron-down" size={20} color="#72CE1D" />
        </TouchableOpacity>

        {/* Started on */}
        <Text style={styles.label}>Started on</Text>
        <TouchableOpacity style={styles.inputRow} onPress={selectDate}>
          <Text style={styles.valueText}>{startDate || 'Select date'}</Text>
          <Ionicons name="chevron-down" size={20} color="#72CE1D" />
        </TouchableOpacity>

        {/* Payment Method */}
        <Text style={styles.label}>Payment Method</Text>
        <TouchableOpacity style={styles.inputRow} onPress={selectPaymentMethod}>
          <Text style={styles.valueText}>{paymentMethod || ''}</Text>
          <Ionicons name="chevron-down" size={20} color="#72CE1D" />
        </TouchableOpacity>

        {/* Remind me */}
        <Text style={styles.label}>Remind me</Text>
        <TouchableOpacity style={styles.inputRow} onPress={selectRemindMe}>
          <Text style={styles.valueText}>{remindMe || 'Never'}</Text>
          <Ionicons name="chevron-down" size={20} color="#72CE1D" />
        </TouchableOpacity>

      </View>

      {/* Bouton “Add” */}
      <TouchableOpacity style={styles.button} onPress={handleAdd}>
        <Text style={styles.buttonText}>Add</Text>
      </TouchableOpacity>
    </SafeAreaView>
  );
}

export default CustomSubscriptionScreen;
