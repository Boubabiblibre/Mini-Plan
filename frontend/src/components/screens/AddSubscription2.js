import React, { useState } from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  SafeAreaView,
  Image,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons'; // Assurez-vous d'avoir installé react-native-vector-icons
import styles from '../../styles/AddSubscription2Styles'

const AddSubscription2 = () => {
  // États pour chaque champ (exemple)
  const [cycle, setCycle] = useState('Monthly');
  const [startDate, setStartDate] = useState('');
  const [paymentMethod, setPaymentMethod] = useState('');
  const [remindMe, setRemindMe] = useState('Never');

  // Exemple de logique quand l’utilisateur valide le formulaire
  const handleAddSubscription = () => {
    // Faire les validations / envoi API, etc.
    console.log('Added subscription with: ', {
      cycle,
      startDate,
      paymentMethod,
      remindMe,
    });
  };

  // Exemple de fonctions pour changer les valeurs (en vrai, tu peux ouvrir un DatePicker, un Picker, etc.)
  const selectCycle = () => {
    // Ouvre un modal / un picker pour choisir 'Monthly', 'Yearly', etc.
    setCycle(cycle === 'Monthly' ? 'Yearly' : 'Monthly');
  };

  const selectStartDate = () => {
    // Ouvre un date picker
    setStartDate('2025-03-15'); // Juste un exemple
  };

  const selectPaymentMethod = () => {
    // Ouvre un modal ou un picker
    setPaymentMethod(paymentMethod === 'Visa' ? 'Paypal' : 'Visa');
  };

  const selectRemindMe = () => {
    // Ouvre un modal ou un picker
    setRemindMe(remindMe === 'Never' ? 'Every month' : 'Never');
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Header */}
      <View style={styles.header}>
        <TouchableOpacity
          style={styles.backButton}
          onPress={() => navigation?.goBack?.()}
        >
          <Ionicons name="arrow-back" size={24} color="#72CE1D" />
        </TouchableOpacity>
      </View>

      {/* Logo YouTube */}
      <View style={styles.logoContainer}>
        {/* Exemple si tu as une icône YouTube dans tes assets :
            <Image source={require('../assets/youtube.png')} style={styles.youtubeLogo} />
          Si tu veux juste un Ionicons ou FontAwesome, adapte en conséquence.
        */}
        <View style={styles.logoBorder}>
          <Image
            source={require('../assets/youtube.png')} 
            style={styles.youtubeLogo}
          />
        </View>
        <Text style={styles.title}>YOUTUBE</Text>
      </View>

      {/* Champs */}
      <View style={styles.formContainer}>
        {/* Cycle */}
        <TouchableOpacity style={styles.inputRow} onPress={selectCycle}>
          <Text style={styles.label}>Cycle</Text>
          <View style={styles.rightSection}>
            <Text style={styles.valueText}>{cycle || 'Monthly'}</Text>
            <Ionicons name="chevron-down" size={20} color="#72CE1D" style={styles.iconRight} />
          </View>
        </TouchableOpacity>

        {/* Started on */}
        <TouchableOpacity style={styles.inputRow} onPress={selectStartDate}>
          <Text style={styles.label}>Started on</Text>
          <View style={styles.rightSection}>
            <Text style={styles.valueText}>{startDate || 'Select date'}</Text>
            <Ionicons name="chevron-down" size={20} color="#72CE1D" style={styles.iconRight} />
          </View>
        </TouchableOpacity>

        {/* Payment Method */}
        <TouchableOpacity style={styles.inputRow} onPress={selectPaymentMethod}>
          <Text style={styles.label}>Payment Method</Text>
          <View style={styles.rightSection}>
            <Text style={styles.valueText}>{paymentMethod || ''}</Text>
            <Ionicons name="chevron-down" size={20} color="#72CE1D" style={styles.iconRight} />
          </View>
        </TouchableOpacity>

        {/* Remind me */}
        <TouchableOpacity style={styles.inputRow} onPress={selectRemindMe}>
          <Text style={styles.label}>Remind me</Text>
          <View style={styles.rightSection}>
            <Text style={styles.valueText}>{remindMe || 'Never'}</Text>
            <Ionicons name="chevron-down" size={20} color="#72CE1D" style={styles.iconRight} />
          </View>
        </TouchableOpacity>
      </View>

      {/* Bouton d’action */}
      <TouchableOpacity style={styles.button} onPress={handleAddSubscription}>
        <Text style={styles.buttonText}>Add Subscription</Text>
      </TouchableOpacity>
    </SafeAreaView>
  );
}

export default AddSubscription2;