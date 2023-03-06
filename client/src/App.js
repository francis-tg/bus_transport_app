import Heroes from "./components/Heroes";
import ListReservation from "./components/ListReservation";

function App() {
  return (
    <div className='App'>
      <header className='App-header'>
        <Heroes />
      </header>
      <section id='reservation' className=' bg-base-300 py-5'>
        <ListReservation />
      </section>
    </div>
  );
}

export default App;
