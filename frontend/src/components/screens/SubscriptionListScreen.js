import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  FlatList,
  Image,
  SafeAreaView,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons'; // ou 'react-native-vector-icons/Ionicons'
import styles from '../../styles/SubscriptionListStyles';

// Exemple de données mock (icônes depuis un require local ou depuis un URL)
const SUBSCRIPTIONS = [
  {
    id: '1',
    name: 'Netflix',
    icon: require('../assets/netflix.png'), // À adapter
  },
  {
    id: '2',
    name: 'Amazon',
    icon: require('../assets/amazon.png'), // À adapter
  },
  {
    id: '3',
    name: 'Spotify',
    icon: require('../assets/spotify.png'), // À adapter
  },
  {
    id: '4',
    name: 'Youtube',
    icon: require('../assets/youtube.png'), // À adapter
  },
  {
    id: '5',
    name: 'Prime',
    icon: require('../assets/prime.png'), // À adapter
  },
  {
    id: '6',
    name: 'Prime',
    icon: require('../assets/prime.png'), // Duplicate pour l’exemple
  },
];

const SubscriptionListScreen = ({ navigation }) => {
  const [searchText, setSearchText] = useState('');

  // Filtre simple sur la liste en fonction de searchText
  const filteredSubscriptions = SUBSCRIPTIONS.filter(subscription =>
    subscription.name.toLowerCase().includes(searchText.toLowerCase())
  );

  const renderSubscriptionItem = ({ item }) => (
    <View style={styles.cardContainer}>
      {/* Logo du service */}
      <View style={styles.logoContainer}>
        {/* Utiliser <Image> pour un logo local ou <Ionicons> pour un icône */}
        <Image source={item.icon} style={styles.logoImage} />
      </View>
      <Text style={styles.subscriptionName}>{item.name}</Text>

      {/* Bouton + */}
      <TouchableOpacity
        style={styles.plusButton}
        onPress={() => console.log('Add: ', item.name)}
      >
        <View style={styles.plusButtonCircle}>
          <Text style={styles.plusSign}>+</Text>
        </View>
      </TouchableOpacity>
    </View>
  );

  const handleCustomSubscription = () => {
    // Logique quand on clique sur "Custom Subscription"
    // Par exemple : navigation.navigate('AddCustomSubscription')
    console.log('Custom Subscription clicked');
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Barre de recherche */}
      <View style={styles.searchContainer}>
        <TextInput
          style={styles.searchInput}
          placeholder="Search"
          placeholderTextColor="#72CE1D"
          value={searchText}
          onChangeText={setSearchText}
        />
        <TouchableOpacity
          style={styles.searchButton}
          onPress={() => console.log('Search:', searchText)}
        >
          <Ionicons name="search" size={24} color="#72CE1D" />
        </TouchableOpacity>
      </View>

      {/* Bouton pour abonnement personnalisé */}
      <TouchableOpacity
        style={styles.customSubscriptionContainer}
        onPress={handleCustomSubscription}
      >
        <Text style={styles.customSubscriptionText}>Custom Subscription</Text>
        <Ionicons name="chevron-forward" size={24} color="#72CE1D" />
      </TouchableOpacity>

      {/* Liste des abonnements existants */}
      <FlatList
        data={filteredSubscriptions}
        keyExtractor={(item) => item.id}
        renderItem={renderSubscriptionItem}
        contentContainerStyle={styles.listContentContainer}
      />
    </SafeAreaView>
  );
}

export default SubscriptionListScreen;
