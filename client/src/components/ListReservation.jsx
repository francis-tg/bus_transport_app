import React from "react";
import Reservation from "./Reservation";
import {toast} from "react-toastify";
function ListReservation() {
  const [Trajets, setTrajet] = React.useState([]);
  async function fecthTrajets() {
    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/trajet-all`,
      {
        method: "GET"
      }
    )
      .then(async (response) => {
        if (response.status === 200) {
          const data = await response.json();
          setTrajet(data);
        }
      })
      .catch((err) => toast.error("Une erreur est survenue..."));
  }
  React.useEffect(() => {
    fecthTrajets();

    return () => {};
  }, []);

  return (
    <div className='flex flex-col md:flex-row items-center gap-10 lg:flex-row flex-wrap lg:mx-32 mt-5 p-5 lg:p-3'>
      {Trajets.map((trajet, i) => (
        <div className='' key={i}>
          <Reservation data={trajet} />
        </div>
      ))}
    </div>
  );
}

export default ListReservation;
