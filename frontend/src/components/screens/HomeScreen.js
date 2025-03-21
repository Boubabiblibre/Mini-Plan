import React from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet } from 'react-native';
import styles from '../../styles/HomeStyles';

const HomeScreen = ({ navigation }) => {
  return (
    <View style={styles.container}>
      
      <View style={styles.introContainer}>
        <Text style={styles.introTitle}>Gérez facilement vos abonnements en famille</Text>
        <Text style={styles.introText}>Gardez le contrôle de vos paiements et évitez les mauvaises surprises</Text>
      </View>
      
      <TouchableOpacity style={styles.button} onPress={() => navigation.navigate('Login')}>
        <Text style={styles.buttonText}>CONNEXION</Text>
      </TouchableOpacity>
      
      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('Register')}>
        <Text style={styles.buttonText}>INSCRIPTION</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('Dashboard')}>
        <Text style={styles.buttonText}>DASHBOARD</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('SubscriptionList')}>
        <Text style={styles.buttonText}>SUBSCRIPTION LIST</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('ActiveSubscription')}>
        <Text style={styles.buttonText}>ACTIVE SUBSCRIPTION</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('AddSubscription')}>
        <Text style={styles.buttonText}>ADD SUBSCRIPTION</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('AddSubscription2')}>
        <Text style={styles.buttonText}>ADD SUBSCRIPTION 2</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('CustomSubscription')}>
        <Text style={styles.buttonText}>CUSTOM LIST SUBSCRIPTION</Text>
      </TouchableOpacity>
    </View>
  );
};

export default HomeScreen;