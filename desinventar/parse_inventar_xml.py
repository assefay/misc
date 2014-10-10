# coding=utf-8
"""
Parsing xml from desinventar data base

Format 
<DESINVENTAR>
<datamodel>
</datamodel>
<eventos>

</eventos>
<causas>

</causas>

<niveles>
level (region, zone, wereda)
</nivels>
<lev0>
level name of all items that fell into this level
</lev0>
<lev1>
</lev1>
<lev2>
</lev2>
<regiones>
<TR><codregion>01</codregion>
<nombre>Tigray</nombre>
<nombre_en>Tigray</nombre_en>
...

<diccionario>
<fichas>^M

<TR><serial>9996</serial>^M
<level0>03</level0>^M
<level1></level1>^M
<level2></level2>^M
<name0>Amhara</name0>^M
<name1></name1>^M
<name2></name2>^M
<evento>EPIDEMIC</evento>^M
<lugar>Dire Dawa</lugar>^M
<fechano>2008</fechano>^M
<fechames>7</fechames>^M
<fechadia>18</fechadia>^M
<muertos>0</muertos>^M
<heridos>0</heridos>^M
<desaparece>0</desaparece>^M
<afectados>0</afectados>^M
<vivdest>0</vivdest>^M
<vivafec>0</vivafec>^M
<otros></otros>^M
<fuentes>Addis Ababa Bureau Of Health, Accessed From IDSR Team Leader Sister Seblework Tadesse, September 2007.;;</fuentes>^M
<valorloc>0.0</valorloc>^M
<valorus>0.0</valorus>^M
<fechapor>Anonimous</fechapor>^M
<fechafec>2012-06-28</fechafec>^M
<hay_muertos>0</hay_muertos>^M
<hay_heridos>0</hay_heridos>^M
<hay_deasparece>0</hay_deasparece>^M
<hay_afectados>-1</hay_afectados>^M
<hay_vivdest>0</hay_vivdest>^M
<hay_vivafec>0</hay_vivafec>^M
<hay_otros>0</hay_otros>^M
<socorro>0</socorro>^M
<salud>0</salud>^M
<educacion>0</educacion>^M
<agropecuario>0</agropecuario>^M
<industrias>0</industrias>^M
<acueducto>0</acueducto>^M
<alcantarillado>0</alcantarillado>^
<energia>0</energia>^M
<comunicaciones>0</comunicaciones>^M
<causa></causa>^M
<descausa>Acute Watery Diarrhoea (AWD)</descausa>^M
<transporte>0</transporte>^M
<Magnitud2></Magnitud2>^M
<nhospitales>0</nhospitales>^M
<nescuelas>0</nescuelas>^M
<nhectareas>0.0</nhectareas>^M
<cabezas>0</cabezas>^M
<Kmvias>0.0</Kmvias>^M
<duracion>0</duracion>^M
<damnificados>0</damnificados>^M
<evacuados>0</evacuados>^M
<hay_damnificados>0</hay_damnificados>^M
<hay_evacuados>0</hay_evacuados>^M
<hay_reubicados>0</hay_reubicados>^M
<reubicados>0</reubicados>^M
<clave>24217</clave>^M
<glide></glide>^M
<defaultab></defaultab>^M
<approved>4</approved>^M
<latitude>0.0</latitude>^M
<longitude>0.0</longitude>^M
<uu_id>8C00A913-24F0-4DA1-96C4-027E5BE6429A</uu_id>^M
<di_comments></di_comments>^M
</TR>^
....
<TR><serial>19662</serial>^M
<level0>14</level0>^M
<level1></level1>^M
<level2></level2>^M
<name0></name0>^M
<name1></name1>^M
<name2></name2>^M
<evento>DROUGHT</evento>^M
<lugar></lugar>^M
<fechano>1992</fechano>^M
<fechames>9</fechames>^M
<fechadia>7</fechadia>^M
<muertos>0</muertos>^M
<heridos>0</heridos>^M
<desaparece>0</desaparece>^M
<afectados>206216</afectados>^M
<vivdest>0</vivdest>^M
<vivafec>0</vivafec>^M
<otros></otros>^M
<fuentes>Disaster Prevention and Preparedness Agency (DPPA)</fuentes>^M
<valorloc>0.0</valorloc>^M
<valorus>0.0</valorus>^M
<fechapor></fechapor>^M
<fechafec>2011-09-07</fechafec>^M
<hay_muertos>0</hay_muertos>^M
<hay_heridos>0</hay_heridos>^M
<hay_deasparece>0</hay_deasparece>^M
<hay_afectados>-1</hay_afectados>^M
<hay_vivdest>0</hay_vivdest>^M
<hay_vivafec>0</hay_vivafec>^M
<hay_otros>0</hay_otros>^M
<socorro>0</socorro>^M
<salud>0</salud>^M
<educacion>0</educacion>^M
<agropecuario>0</agropecuario>^M
<industrias>0</industrias>^M
<acueducto>0</acueducto>^M
<alcantarillado>0</alcantarillado>^M
<energia>0</energia>^M
<comunicaciones>0</comunicaciones>^M
<causa></causa>^M
<descausa>Drought</descausa>^M
<transporte>0</transporte>^M
<Magnitud2></Magnitud2>^M
<nhospitales>0</nhospitales>^M
<nescuelas>0</nescuelas>^M
<nhectareas>0.0</nhectareas>^M
<cabezas>0</cabezas>^M
<Kmvias>0.0</Kmvias>^M
<duracion>0</duracion>^M
<damnificados>0</damnificados>^M
<evacuados>0</evacuados>^M
<hay_damnificados>0</hay_damnificados>^M
<hay_evacuados>0</hay_evacuados>^M
<hay_reubicados>0</hay_reubicados>^M
<reubicados>0</reubicados>^M
<clave>25998</clave>^M
<glide></glide>^M
<defaultab></defaultab>^M
<approved>0</approved>^M
<latitude>0.0</latitude>^M
<longitude>0.0</longitude>^M
<uu_id>7480B89C-0114-48B6-BC11-97B607CBA710</uu_id>^M
<di_comments></di_comments>^M
</TR>^M
</fichas>
<extension>
??
</extension>
<level_maps>
</level_maps>
<info_maps>
</info_maps>
<level_attributes>
</level_attributes>
<attribute_metadata>
</attribute_metadata>
</DESINVENTAR>


"""

import xml.etree.ElementTree as etree
import csv
import sys, getopt

def export_all_events(input_file, output_file, start_year=None):
    export_selected_event(input_file, output_file, 'ALL', start_year)

"""
export using an event. Event is expected to be somthing like DOUGHT or FLOOD or ALL to export all events  
"""
def export_selected_event(input_file, output_file, event, start_year=None):
    tree = etree.parse(input_file)
    root = tree.getroot()
    fichas = tree.find('fichas')

    #get first child for header
    tr_child = fichas.find('TR')
    header = []
    for child in tr_child:
        header.append( child.tag)
    

    csv_file = open(output_file, "wb") 
    writer = csv.writer(csv_file, delimiter=',')
    writer.writerow(header)

    row_data = []
    for tr in fichas:
        row_data = []
        #get event value
        event_value = tr.find('evento').text
        year = int(tr.find('fechano').text)
        if ((event_value.strip().lower() == event.strip().lower() or event.upper() == 'ALL') and (start_year == None or year >= int(start_year))):
            for tr_child in tr:
                row_data.append(tr_child.text);
            writer.writerow([unicode(s).encode("utf-8") for s in row_data])

"""
aggregate results using a level. event can be either unique name sucha as FLOOD.
aggregation is done on the field affectados. For an event=FLOOD, outpout file will have :
level, affectados_FLOOD. 
"""
def export_aggregate_events(input_file, output_file, event, aggregate_level, start_year=None):
    print 'export_aggregate_events ' ,  start_year

    levels = {}
    
    tree = etree.parse(input_file)
    root = tree.getroot()
    fichas = tree.find('fichas')

    #get first child for header
    tr_child = fichas.find('TR')
    header = [aggregate_level, 'afectados_'+event]

    csv_file = open(output_file, "wb") 
    writer = csv.writer(csv_file, delimiter=',')
    writer.writerow(header)


    for tr in fichas:
        #get event value
        event_value = tr.find('evento').text
        level_value = tr.find(aggregate_level).text #assume inout is valid : It should be level0 or level1 or level2
        affected = tr.find('afectados').text
        year = int(tr.find('fechano').text.strip())

        if ((event_value.strip().lower() == event.strip().lower()) and (start_year == None or year >= int(start_year))):
            if levels.has_key(level_value):
                levels[level_value] = levels[level_value] + int(affected)
            else:
                levels[level_value] = int(affected)
     
    for key, value in levels.items():
        writer.writerow([key, value])


    
def main(argv):

    try:
        opts, args = getopt.getopt(argv,"i:e:o:a:y:")
    except getopt.GetoptError:
        print 'paser_invetar_xml.py -i <xlml_db>  -e <DROUGHT[,FLOOD,ALL]> -o <outputfile> [-a <levelid>] [-y <start_year>]'
        sys.exit(2)

    event = None
    input_file = None
    output_file = None
    aggregate_level = None
    start_year = None

    for opt, arg in opts:
        if opt == '-e':
            event = arg
        elif  opt == '-o':
            output_file = arg
        elif  opt == '-i':
            input_file = arg
        elif opt == '-a':
            aggregate_level = arg
        elif opt == '-a':
            aggregate_level = arg
        elif opt == '-y':
            start_year = arg
            
       
    if (event == None or output_file == None or input_file == None):
        print 'paser_invetar_xml.py -i <xlml_db> -e <DROUGHT[,FLOOD,ALL]> -o <outputfile> [-a <levelid>]'
        sys.exit(2)
    
    if (event == 'ALL'):
        export_all_events(input_file, output_file, start_year)
    elif (aggregate_level == None):
        export_selected_event(input_file, output_file, event, start_year)
    else:
       export_aggregate_events(input_file, output_file, event, aggregate_level, start_year) 
    

if __name__ == "__main__":
    main(sys.argv[1:])



#python parse_inventar_xml.py -i DI_export_eth.xml -e ALL  -o all.csv

#python parse_inventar_xml.py -i DI_export_eth.xml -e DROUGHT  -o drought.csv
#python parse_inventar_xml.py -i DI_export_eth.xml -e DROUGHT  -o drought_level0.csv -a level0
#python parse_inventar_xml.py -i DI_export_eth.xml -e DROUGHT  -o drought_from_1990.csv -y 1990
#python parse_inventar_xml.py -i DI_export_eth.xml -e DROUGHT  -o drought_level0_from_1990.csv -a level0 -y 1990
 

#python parse_inventar_xml.py -i DI_export_eth.xml -e FLOOD  -o flood.csv
#python parse_inventar_xml.py -i DI_export_eth.xml -e FLOOD  -o flood_level0.csv -a level0
#python parse_inventar_xml.py -i DI_export_eth.xml -e FLOOD  -o flood_from_1990.csv -y 1990
#python parse_inventar_xml.py -i DI_export_eth.xml -e FLOOD  -o flood_level0_from_1990.csv -a level0 -y 1990
 
