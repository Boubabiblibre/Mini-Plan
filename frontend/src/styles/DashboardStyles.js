import { StyleSheet } from 'react-native';

const DashboardStyles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#000',
        padding: 20
    },
    tabsContainer: {
        flexDirection: 'row',
        justifyContent: 'center',
        marginBottom: 20
    },
    activeTab: {
        backgroundColor: '#fff',
        padding: 10,
        borderRadius: 20
    },
    inactiveTab: {
        backgroundColor: '#333',
        padding: 10,
        borderRadius: 20,
        marginLeft: 10
    },
    activeTabText: {
        fontWeight: 'bold'
    },
    inactiveTabText: {
        color: '#aaa'
    },
    greeting: {
        fontSize: 22,
        fontWeight: 'bold',
        color: '#fff',
        marginBottom: 10
    },
    section: {
        marginBottom: 20
    },
    sectionHeader: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        marginBottom: 10
    },
    sectionTitle: {
        color: '#fff',
        fontSize: 18,
        fontWeight: 'bold'
    },
    seeMore: {
        color: '#A6FF00',
        fontSize: 14
    },
    card: {
        backgroundColor: '#222',
        padding: 15,
        borderRadius: 10
    },
    cardText: {
        color: '#fff',
        marginBottom: 5
    },
    amount: {
        color: '#A6FF00',
        fontSize: 22,
        fontWeight: 'bold'
    },
    perMonth: {
        fontSize: 14,
        color: '#A6FF00'
    },
    calendarContainer: {
        flexDirection: 'row',
        justifyContent: 'space-between'
    },
    date: {
        backgroundColor: '#333',
        padding: 10,
        borderRadius: 20
    },
    selectedDate: {
        backgroundColor: '#A6FF00',
        padding: 10,
        borderRadius: 20
    },
    dateText: {
        color: '#fff'
    },
    selectedDateText: {
        color: '#000',
        fontWeight: 'bold'
    },
    filterContainer: {
        flexDirection: 'row',
        justifyContent: 'center',
        marginBottom: 20
    },
    activeFilter: { 
        backgroundColor: '#A6FF00', 
        padding: 10, 
        borderRadius: 20, 
        marginHorizontal: 5 
    },
    inactiveFilter: { 
        backgroundColor: '#333', 
        padding: 10, 
        borderRadius: 20, 
        marginHorizontal: 5 
    },
    activeFilterText: { 
        fontWeight: 'bold' 
    },
    inactiveFilterText: { 
        color: '#aaa' 
    },
    subscriptionCard: { 
        backgroundColor: '#222', 
        padding: 15, 
        borderRadius: 10, 
        flexDirection: 'row', 
        justifyContent: 'space-between', 
        alignItems: 'center' 
    },
    subscriptionLeft: { 
        flexDirection: 'row', 
        alignItems: 'center' 
    },
    logoBox: { 
        backgroundColor: '#FFA500', 
        padding: 10, 
        borderRadius: 5, 
        marginRight: 10 
    },
    logoText: { 
        color: '#000', 
        fontWeight: 'bold' 
    },
    subscriptionTitle: { 
        color: '#fff', 
        fontWeight: 'bold' 
    },
    subscriptionDesc: { 
        color: '#aaa', 
        fontSize: 12 
    },
    subscriptionPrice: { 
        color: '#A6FF00', 
        fontSize: 18, 
        fontWeight: 'bold' 
    },
});

export default DashboardStyles;