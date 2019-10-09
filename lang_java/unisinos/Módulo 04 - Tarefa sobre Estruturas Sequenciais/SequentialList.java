
public class SequentialList {
	
	protected Object list[];
	protected int last=-1;

	public SequentialList (int size){
		list = new Object(size);
	}

	/* Retorna o elemento na posição especificada pelo parâmetro index. */
	public Object get (int index){
		if (index<0 || index>last) return null;
		else return list[index];
	}

	/* Retorna true se o elemento foi inserido no final da lista */
	public Boolean add (Object o) {
		if (isFull()) return false;
		last++;
		list[last]=o;
		return true;
	}

	/* Retorna true se o elemento foi inserido na lista, false caso contrario.
	 * Insere o elemento na posição especificada pelo parâmetro pos */
	public Boolean add (Object o, int pos) {
		if (isFull()) return false;
		for (int i=last+1; i>pos; i--) {
			list[i]=list[i-1];
		}
		last++;
		list[pos]=o;
		return true;
	}

	/* Remove o elemento na posição especificada */
	public Object remove (int index) {
		if (isEmpty()) return null;
		else if (index<0 || index>last) {
			System.out.println ("Índice não existe");
			return null;
		}
		Object o = list[index];
		int numberofElements = last - index;
		if (numberofElements > 0) {
			System.arraycopy(list, index + 1, list, index, numberofElements);
		}
		list[last] = null;
		last--;
		return o;
	}

	/* Verifica se a lista está vazia */
	public Boolean isEmpty (){
		if (last==-1) return true;
		else return false;
	}

	/* Verifica se a lista está cheia */
	public Boolean isFull (){
		if (last==list.length-1) return true;
		else return false;
	}

	/* Retorna o tamanho da lista */
	public int getSize () {
		return last+1;
	}

	//Mostra todos os elementos da lista
	public void print (){
		for (int i=0; i<=last; i++) {
			System.out.println(list[i]);
		}
	}

	public void merge (SequentialList l){
		SequentialList lista_completa = new SequentialList(this.getSize() + l.getSize());

		for (int i = 0; i <= this.getSize(); i++){
			lista_completa.add(this.get(i));			
		}

		for (int i = 0; i <= l.getSize(); i++){
			lista_completa.add(l.get(i));			
		}

		return lista_completa;
	}

	public SequentialList copyList (){
		SequentialList lista_copiada = new SequentialList(this.getSize());
		for (int i = 0; i <= this.getSize(); i++){
			lista_copiada.add(this.get(i));			
		}
		return lista_copiada;
	}
}