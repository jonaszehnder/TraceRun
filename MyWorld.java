import greenfoot.*;
import java.util.*;

/**
 * CandyFlush
 * 
 * @author Jonas Zehnder
 * @version 0.1
 */

public class MyWorld extends World
{
    public ArrayList<Field> fields = new ArrayList<Field>();
    private ArrayList<Field> fieldsTemp = new ArrayList<Field>();
    public ShuffleButton shuffleButton = new ShuffleButton();
    
    public MyWorld()
    {
        super(800, 850, 1);
        prepare();
    }
    
    private void prepare(){
        int arrayCounter = 0;
        for(int x = 1; x <= 8; x++){
            for(int y = 1; y <= 8; y++){
                Field myField = new Field();
                addObject(myField, (x * 90),(y * 90));
                fields.add(myField);
                arrayCounter++;
            }
        }
        
        addObject(shuffleButton, 400, 800);
    }
    
    public void shuffleFields(){
        fieldsTemp = fields;
        Collections.shuffle(fields);
        for(int i = 0; i < fields.size(); i++){
            fields.get(i).setLocation(fieldsTemp.get(i).getX(), fieldsTemp.get(i).getY());
        }
    }
}