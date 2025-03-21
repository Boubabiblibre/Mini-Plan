import React from 'react';
import { 
  View, 
  Text, 
  TouchableOpacity, 
  SafeAreaView, 
  Image 
} from 'react-native';
import styles from '../../styles/ActiveSubscriptionStyles';

const ActiveSubscriptionScreen = () => {
  // Exemples de valeurs : 
  const subscription = {
    name: 'Amazon',
    price: 30, // en euros
    cycle: 'per month',
    paymentDueIn: 4, // jours restants
    // icon: require('../assets/amazon.png'), // chemin d’accès à l’icône Amazon
  };

  // Fonctions éventuelles pour les boutons
  const handleChangePaymentMethod = () => {
    console.log('Change payment method');
    // Navigation ou logique d’ouverture de modal
  };

  const handleCancelSubscription = () => {
    console.log('Cancel Subscription');
    // Navigation ou logique de confirmation
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Carte d’abonnement */}
      <View style={styles.cardContainer}>
        {/* Icône */}
        <Image source={subscription.icon} style={styles.iconStyle} />

        {/* Texte à droite */}
        <View style={styles.infoContainer}>
          <Text style={styles.title}>{subscription.name}</Text>
          <Text style={styles.price}>
            {subscription.price} euros/<Text style={styles.cycle}>{subscription.cycle}</Text>
          </Text>
          <Text style={styles.paymentDue}>
            Payment due in <Text style={styles.highlight}>{subscription.paymentDueIn} days</Text>
          </Text>
        </View>
      </View>

      {/* Boutons en bas */}
      <View style={styles.buttonsContainer}>
        <TouchableOpacity 
          style={styles.changePaymentButton} 
          onPress={handleChangePaymentMethod}
        >
          <Text style={styles.changePaymentText}>Change payment method</Text>
        </TouchableOpacity>

        <TouchableOpacity 
          style={styles.cancelButton} 
          onPress={handleCancelSubscription}
        >
          <Text style={styles.cancelButtonText}>Cancel Subscription</Text>
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

export default ActiveSubscriptionScreen;