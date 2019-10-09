
public static void main (String args[]) {
	SequentialList listaOriginal = new SequentialList(6);
	SequentialList listaToMerge = new SequentialList(3);

	listaOriginal.add(1);
	listaOriginal.add(2);
	listaOriginal.add(3);

	//Print da listaOriginal
	System.out.println("Lista Original");
	listaOriginal.print();

	//MERGE
	listaToMerge.add("a");
	listaToMerge.add("b");
	listaToMerge.add("c");

	//Print da listaToMerge
	System.out.println("Lista para fazer Merge");
	listaToMerge.print();

	SequentialList listaMerge = listaOriginal.merge(listaToMerge);	

	//Print da listaMerge
	System.out.println("Lista Final com Merge");
	listaMerge.print();	

	SequentialList listaCopia = listaMerge.copyList();		

	//Print da listaCopia
	System.out.println("Lista Copiada");
	listaCopia.print();	

}
