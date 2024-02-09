# Java

## Enumerations

Manchmal wollen wir Objekte anhand bestimmter Typen oder Eigenschaften unterscheiden.
Gleichzeitig wollen wir jedoch dem Client Code nur zuvor festgelegte Werte erlauben.
Das ist mit sogenannten ``enums``, also Aufzählungen möglich.

Enums bzw. deren Konstanten sind statische Attribute, die für Vergleiche herangezogen werden können.

````java
public enum AgentType {

    BEGINNER ("Agent für einfache Aufträge"),
    INTERMEDIATE ("Agent für mittlere Aufträge"),
    EXPERT ("Agent für schwierige Aufträge");

    private final String label;

    AgentType(String label) {
        this.label = label;
    }

    public String getLabel() {
        return this.label;
    }

    @Override
    public java.lang.String toString() {
        return this.getLabel();
    }

}
````

Im Folgenden wird die soeben deklarierte ``enum`` in einer anderen Klasse verwendet:

````java
public abstract class Agent {

    protected ArrayList<Vehicle> vehicles = new ArrayList<>();
    protected ArrayList<Equipment> equipment = new ArrayList<>();
    protected AgentType agentType = AgentType.BEGINNER;
    
    // ...
    
}
````

````java
public class Human extends Agent
{

    protected String firstname;
    protected String lastname;

    public Human(String firstname, String lastname, ArrayList<Vehicle> vehicles, ArrayList<Equipment> equipment, AgentType agentType)
    {
        this.firstname = firstname;
        this.lastname = lastname;
        super.vehicles = vehicles; // Statt super funktionert auch this, da Human ja von Agent geerbt hat.
        super.equipment = equipment;
        super.agentType = agentType;
    }
    
    // ...
    
}
````

Nun können wir im Client Code mit der ``enum`` arbeiten:

````java
public class Main {

    public static void main(String[] args)
    {

        Agent bond = new HumanBuilder()
                .setFirstname("James")
                .setLastname("Bond")
                .addVehicle(new CarBuilder().createCar())
                .addEquipment(new Weapon("Pistole"))
                .setType(AgentType.EXPERT)
                .createHuman()
        ;
        
        System.out.println(bond.getAgentType());
        
        switch (bond.getAgentType()) {
            case INTERMEDIATE:
                // tu was
                break;
            case EXPERT:
            case BEGINNER:
                // tu was anderes
                break;
            default:
                // ansonsten tu dies und das
        }
        
    }
}
````

Die meisten **IDE**s schlagen während der Notierung der switch-Anweisung sogar mögliche
Fälle vor:

![Switch Case mit Enum](/docs/img/case_enum.png)