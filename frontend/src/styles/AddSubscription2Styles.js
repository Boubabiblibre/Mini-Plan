import { StyleSheet } from 'react-native';
import AddSubscription2 from '../components/screens/AddSubscription2Screen';

const PURPLE = '#9B51E0'; // Violet du bouton (à ajuster selon ta maquette)
const BORDER_VIOLET = '#C8B6E2'; // Violet clair pour la bordure
const BACKGROUND_DARK = '#1A1A1A'; // Gris très foncé

const AddSubscription2Styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#000', // Fond noir
  },
  // Header (avec la flèche verte)
  header: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingHorizontal: 15,
    paddingTop: 15,
    paddingBottom: 5,
  },
  backButton: {
    padding: 5,
  },

  // Logo container
  logoContainer: {
    alignItems: 'center',
    marginTop: 20,
    marginBottom: 30,
  },
  logoBorder: {
    borderColor: BORDER_VIOLET,
    borderWidth: 2,
    borderRadius: 50,
    padding: 15,
    marginBottom: 10,
  },
  youtubeLogo: {
    width: 50,
    height: 35,
    resizeMode: 'contain',
  },
  title: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },

  // Conteneur du formulaire
  formContainer: {
    marginHorizontal: 20,
    marginBottom: 30,
  },
  // Chaque "champ" (Cycle, Started on, Payment Method, etc.)
  inputRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    backgroundColor: BACKGROUND_DARK,
    borderColor: BORDER_VIOLET,
    borderWidth: 2,
    borderRadius: 10,
    paddingVertical: 15,
    paddingHorizontal: 15,
    marginBottom: 20,
  },
  label: {
    color: '#72CE1D', // Vert
    fontSize: 16,
    fontWeight: '600',
  },
  rightSection: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  valueText: {
    color: '#fff',
    marginRight: 8,
    fontSize: 16,
  },
  iconRight: {
    // Simple marge droite à 0 ou 5, si besoin
  },

  // Bouton principal
  button: {
    backgroundColor: PURPLE,
    alignSelf: 'center',
    paddingHorizontal: 30,
    paddingVertical: 15,
    borderRadius: 25,
  },
  buttonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
});

export default AddSubscription2Styles;
