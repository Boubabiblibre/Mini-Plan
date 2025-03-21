import { StyleSheet } from 'react-native';

const SubscriptionListStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#000', // Fond noir
    paddingHorizontal: 15,
    paddingTop: 10,
  },
  // ==== Recherche ====
  searchContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: '#C8B6E2', // Violet
    borderRadius: 10,
    marginBottom: 20,
    paddingHorizontal: 10,
    backgroundColor: '#1A1A1A', // Gris foncé (à ajuster selon ta maquette)
  },
  searchInput: {
    flex: 1,
    color: '#72CE1D', // Texte vert
    paddingVertical: 10,
  },
  searchButton: {
    padding: 5,
  },

  // ==== Custom Subscription ====
  customSubscriptionContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: '#C8B6E2',
    borderRadius: 10,
    paddingHorizontal: 15,
    paddingVertical: 12,
    marginBottom: 15,
    justifyContent: 'space-between',
    backgroundColor: '#1A1A1A',
  },
  customSubscriptionText: {
    color: '#72CE1D',
    fontSize: 16,
    fontWeight: '600',
  },

  // ==== Liste ====
  listContentContainer: {
    paddingBottom: 20,
  },
  cardContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: '#C8B6E2',
    borderRadius: 10,
    paddingVertical: 12,
    paddingHorizontal: 15,
    marginBottom: 15,
    backgroundColor: '#1A1A1A',
  },
  logoContainer: {
    width: 30,
    height: 30,
    marginRight: 10,
  },
  logoImage: {
    width: '100%',
    height: '100%',
    resizeMode: 'contain',
  },
  subscriptionName: {
    flex: 1,
    color: '#72CE1D',
    fontSize: 16,
    fontWeight: '600',
  },
  plusButton: {
    padding: 5,
  },
  plusButtonCircle: {
    width: 32,
    height: 32,
    borderRadius: 16,
    borderWidth: 1,
    borderColor: '#72CE1D',
    alignItems: 'center',
    justifyContent: 'center',
  },
  plusSign: {
    color: '#72CE1D',
    fontSize: 22,
    marginTop: -2, // Ajuste légèrement pour centrer
  },
});

export default SubscriptionListStyles;