import numpy as np
import random as rd
from scipy import stats

NamesMale = ["Stauros", "Alexandros", "Georgios", "Ioannis", "Nikolaos", "Manolis", "Mixalis", "Stauros", "Vasilis",
             "Ilias", "Iasonas", "Markos", "Christos", "Dimitris", "Kostantinos", "Filippos", "Panagiotis", "Stamatis",
             "Anastasis", "Dionisios"]
NamesFemale = ["Kaliopi", "Anna", "Vasiliki", "Georgia", "Eleni", "Maria", "Verginia", "Vasiliki", "Eugenia", "Korina",
               "Aggeliki", "Aikaterini", "Ioanna", "Viki", "Dimitra", "Iliana", "Despoina", "Marina", "Ariadni",
               "Stamatia", "Ourania", "Anastasia"]

LastNamesFirst = ["Karamp", "Mathioud", "Theodor", "Alex", "Pavl", "Pyrg", "Maur", "Fot", "Farm", "Karageorg", "Mous",
                  "Karamp", "Aslan", "Del", "Kond", "Vamv", "Andr", "Dim", "Kok", "Kosm", "Zach", "Laz", "Vasil",
                  "Vlast", "Xanth", "Span", "Lamp", "Liap", "Nik", "Span", "Stefan", "Papad", "Papageorg", "Marg",
                  "Masl"]
LastNamesSecond_M = ["opoulos", "idis", "akis", "is"]
LastNamesSecond_F = ["opoulou", "idou", "aki", "i"]


def giveMale(number=0, chkList=[]):
    nameList = []
    snameList = []

    for i in range(0, number):

        rd.shuffle(NamesMale)
        rd.shuffle(LastNamesFirst)
        rd.shuffle(LastNamesSecond_M)

        newName = "'" + NamesMale[0] + "','" + LastNamesFirst[0] + LastNamesSecond_M[0] + "','M'"
        sname = NamesMale[0]

        while (newName in nameList):
            newName, sname = giveMale(1)[0]

        snameList.append(sname)
        nameList.append(newName)

    return nameList, snameList


def giveMaleN(number=0, chkList=[]):
    nameList = []
    snameList = []

    for i in range(0, number):

        rd.shuffle(NamesMale)
        rd.shuffle(LastNamesFirst)
        rd.shuffle(LastNamesSecond_M)

        newName = "'" + NamesMale[0] + "','" + LastNamesFirst[0] + LastNamesSecond_M[0] + "'"
        sname = NamesMale[0]

        while (newName in nameList):
            newName, sname = giveMaleN(1)[0]

        snameList.append(sname)
        nameList.append(newName)

    return nameList, snameList


def giveFemale(number=0, chklist=[]):
    nameList = []
    snameList = []

    for i in range(0, number):

        rd.shuffle(NamesFemale)
        rd.shuffle(LastNamesFirst)
        rd.shuffle(LastNamesSecond_F)

        newName = "'" + NamesFemale[0] + "','" + LastNamesFirst[0] + LastNamesSecond_F[0] + "','F'"
        sname = NamesFemale[0]

        while (newName in nameList):
            newName, sname = giveFemale(1)[0]

        snameList.append(sname)
        nameList.append(newName)

    return nameList, snameList


def giveFemaleN(number=0, chklist=[]):
    nameList = []
    snameList = []

    for i in range(0, number):

        rd.shuffle(NamesFemale)
        rd.shuffle(LastNamesFirst)
        rd.shuffle(LastNamesSecond_F)

        newName = "'" + NamesFemale[0] + "','" + LastNamesFirst[0] + LastNamesSecond_F[0] + "'"
        sname = NamesFemale[0]

        while (newName in nameList):
            newName, sname = giveFemaleN(1)[0]

        snameList.append(sname)
        nameList.append(newName)

    return nameList, snameList


def giveMixed(number, chklist=[]):
    maleNumber = int(round(number * rd.random()))
    femaleNumber = number - maleNumber

    nameList, snameList = giveMale(maleNumber, chklist)
    tmp, stmp = giveFemale(femaleNumber, chklist)

    for i in tmp:
        nameList.append(i)
    for i in stmp:
        snameList.append(i)

    return nameList, snameList


def giveMixedN(number, chklist=[]):
    maleNumber = int(round(number * rd.random()))
    femaleNumber = number - maleNumber

    nameList, snameList = giveMaleN(maleNumber, chklist)
    tmp, stmp = giveFemaleN(femaleNumber, chklist)

    for i in tmp:
        nameList.append(i)
    for i in stmp:
        snameList.append(i)

    return nameList, snameList


def givePhoneNumber(number, chklist=[]):
    phoneList = []
    for i in range(0, number):
        phone = "'+3069" + str(int(round(100000000 * rd.random()))) + "'"
        if (phone in phoneList) or (phone in chklist):
            phone = givePhoneNumber(1)[0]
        phoneList.append(phone)
    return phoneList


def giveRandomDate(number, minyear=2000, maxplus=19):
    dateList = []

    for i in range(0, number):
        dateList.append("'" + str(minyear + int(round(maxplus * rd.random()))) + "-" + str(
            int(round(1 + 11 * rd.random()))) + "-" + str(int(round(1 + 29 * rd.random()))) + "'")

    return dateList


Letters = ["E", "H", "I", "K"]


def giveRandomID(number, chklist=[]):
    idList = []

    for i in range(0, number):
        rd.shuffle(Letters)
        newID = "'A" + Letters[0] + str(int(round(100000 + 100000 * rd.random()))) + "'"
        while (newID in idList) or (newID in chklist):
            newID = giveRandomID(1)[0]
        idList.append(newID)

    return idList


def giveRandomSSN(number, chklist=[]):
    ssnList = []

    for i in range(0, number):
        newSSN = str(int(round(100000000000 * rd.random())))
        while (newSSN in ssnList) or (newSSN in chklist):
            newSSN = giveRandomSSN(1)[0]
        ssnList.append(newSSN)

    return ssnList


def giveRandomAFM(number, chklist=[]):
    ssnList = []

    for i in range(0, number):
        newSSN = str(int(round(10000000000 * rd.random())))
        while (newSSN in ssnList) or (newSSN in chklist):
            newSSN = giveRandomAFM(1)[0]
        ssnList.append(newSSN)

    return ssnList


def giveRandomPay(number):
    payList = []
    for i in range(0, number):
        payList.append(str(int(round(14000 + 10000 * rd.random()))))
    return payList


def giveWorkTime(number):
    payList = []
    for i in range(0, number):
        payList.append(str(int(round(25 + 15 * rd.random()))))
    return payList


def giveFlourAndNumber(number, maxflr):
    flList = []

    for i in range(0, number):
        flr = str(int(round(1 + maxflr * rd.random())))
        rnmbr = flr + str(int(round(1 * rd.random()))) + str(int(round(9 * rd.random())))
        comb = flr + "," + rnmbr

        while comb in flList:
            comb = giveFlourAndNumber(1)[0]
        flList.append(comb)

    return flList


def giveRandomOwnedMoney(number):
    payList = []
    for i in range(0, number):
        payList.append(str(int(round(10000 * rd.random()))))
    return payList


blood = ["'A+'", "'A-'", "'B+'", "'B-'", "'AB+'", "'AB-'", "'O+'", "'O-'"]


def giveDoctor(number, ids, sid):
    pathologoi = []
    kardiologoi = []
    pneumatologoi = []
    whatever = []
    for i in range(0, len(sid)):
        if sid[i] == 2:
            kardiologoi.append(i)
        if sid[i] == 3:
            pneumatologoi.append(i)
        if sid[i] == 1:
            pathologoi.append(i)
        if sid[i] > 3:
            whatever.append(i)

    conditions = ["Adiathesia", "Imikrania", "Provlima stin Anapnoi", "Stomaxikoi Ponoi", "Xamili/Ypsili piesi",
                  "Atyxima", "Anexigito"]

    clist = []
    dIDList = []

    for i in range(0, number):
        nmb = int(round(6 * rd.random()))
        clist.append(conditions[nmb])
        if (nmb == 0 or nmb == 1 or nmb == 2 or nmb == 3) and len(pathologoi) > 0:
            dIDList.append(ids[rd.choice(pathologoi)])
        if nmb == 2 and len(pneumatologoi) > 0:
            dIDList.append(ids[rd.choice(pneumatologoi)])
        if nmb == 4 and len(kardiologoi) > 0:
            dIDList.append(ids[rd.choice(kardiologoi)])
        if nmb > 4 or ((nmb == 0 or nmb == 1 or nmb == 2 or nmb == 3) and len(pathologoi) == 0) or (
                nmb == 2 and len(pneumatologoi) == 0) or (nmb == 4 and len(kardiologoi) == 0):
            dIDList.append(ids[rd.choice(whatever)])

    return dIDList, clist


def giveRandomBlood(number):
    bloodList = []
    for i in range(0, number):
        rd.shuffle(blood)
        bloodList.append(blood[0])
    return bloodList


domain = ["@gmail", "@outlook", "@hotmail", "@yahoo"]
origin = [".gr'", ".com'"]


def giveMailToPeople(nameList, snameList):
    for i in range(0, len(snameList)):
        mail = "'" + snameList[i][0:int(round(3 + (len(snameList[i]) - 4) * rd.random()))] + str(
            int(round(11 + 88 * rd.random()))) + domain[int(round(3 * rd.random()))] + origin[int(round(rd.random()))]
        nameList[i] = nameList[i] + "," + mail
    return nameList


specialty = ["'Nosileutis'", "'Nosileutis'", "'Nosileutis'", "'Nosileutis'", "'Nosileutis'", "'Nosileutis'",
             "'Pathologos'", "'Pathologos'", "'Pathologos'", "'Kardiologos'", "'Kardiologos'", "'Pneumatologos'",
             "'Pneumatologos'", "'Othalmiatros'", "'Gynaikologos'", "'Odontiatros'", "'Orthopedikos'", "'Paidiatros'",
             "'Mikroviologos'", "'Ogologos'", "'Chirourgos'", "'Psyxiatros'", "'Endokrinologos'"]
department = ["'Nosileutiko'", "'Nosileutiko'", "'Nosileutiko'", "'Nosileutiko'", "'Nosileutiko'", "'Nosileutiko'",
              "'Pathologiko'", "'Pathologiko'", "'Pathologiko'", "'Kardiologiko'", "'Kardiologiko'", "'Pneumatologiko'",
              "'Pneumatologiko'", "'Othalmiatriko'", "'Gynaikologiko'", "'Odontiatriko'", "'Orthopediko'",
              "'Paidiatriko'", "'Mikroviologiko'", "'Ogologiko'", "'Chirourgiko'", "'Psyxiatriko'", "'Endorkinologiko'"]
sid = [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 2, 2, 3, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]


def giveRandomSpecialtyAndDepartment(number):
    slist = []
    dlist = []
    idlist = []
    for i in range(0, number):
        nmb = int(round((len(specialty) - 1) * rd.random()))
        slist.append(specialty[nmb])
        dlist.append(department[nmb])
        idlist.append(sid[nmb])
    return slist, dlist, idlist


Towns = ["Alexandroupoli", "Kommotini", "Xanthi", "Kavala", "Drama", "Serres"]
Streets = ["'28hs Oktomvriou'", "'Karaoli'", "'Dionysiou'", "'Aidiniou'", "'Roumeliwn'", "'Perikleous'",
           "'Andreou Dimitriou'", "'Tsimiski'", "'Vasileous Sofias'", "'Marathonos'", "'Korai'", "'Antioxias'",
           "'Riga Fereou'", "'Thermopilon'", "'Panagi Tsaldari'", "'Makedonomaxon'", "'Eleutheriou Venizelou'"]


def giveRandomLocation(number, cklist=[]):
    rd.shuffle(Towns)
    rd.shuffle(Streets)
    locList = []
    for i in range(0, number):
        loc = "'" + Towns[0] + "'," + Streets[0] + ",'" + str(int(round(1 + 130 * rd.random()))) + "'"
        while (loc in locList):
            loc = giveRandomLocation(1)[0]
        locList.append(loc)
    return locList


def giveRandomStreet(number, cklist=[]):
    rd.shuffle(Streets)
    locList = []
    for i in range(0, number):
        loc = "" + Streets[0] + ",'" + str(int(round(1 + 130 * rd.random()))) + "'"
        while (loc in locList) or (loc in cklist):
            loc = giveRandomStreet(1)[0]
        locList.append(loc)
    return locList


def employees(number, loc, clinicID, checkNames=[], checkStreets=[], checkAFM=[], checkSSN=[], checkID=[],
              checkPhone=[]):
    a, b = giveMixed(number, checkNames)
    cnames = a
    for i in checkNames:
        cnames.append(i)
    full_names = giveMailToPeople(a, b)
    rd.shuffle(full_names)

    streets = giveRandomStreet(number, checkStreets)
    cstreets = streets
    for i in checkStreets:
        cstreets.append(i)

    SSN = giveRandomSSN(number, checkSSN)
    cSSN = SSN
    for i in checkSSN:
        cSSN.append(i)

    AFM = giveRandomAFM(number, checkAFM)
    cAFM = AFM
    for i in checkAFM:
        cAFM.append(i)

    ID = giveRandomID(number, checkID)
    cID = ID
    for i in checkID:
        cID.append(i)

    bdates = giveRandomDate(number, 1940, 54)

    phones = givePhoneNumber(number, checkPhone)
    cphones = phones
    for i in checkPhone:
        cphones.append(i)

    specialty, depart, idlist = giveRandomSpecialtyAndDepartment(number)

    hire_date = giveRandomDate(number - 8, 2010, 1)
    for i in range(0, 8):
        hire_date.append(giveRandomDate(1, 2010, i)[0])

    salary = giveRandomPay(number)

    hoursperweek = giveWorkTime(number)

    vacation = []

    for i in range(0, number):
        vacation.append(str(int(round(0.6 * rd.random())) * int(round(4 * rd.random()))))
    full = []

    for i in range(0, number):
        full.append(
            "INSERT INTO employees(id,name,surname,gender,email,addr_city,addr_street,addr_number,birth_date,amka,afm,telephone,specialty,department_name,hire_date,salary,hours_per_week,vacation_days_left,dept_clinic_id) VALUES (" +
            ID[i] + "," + full_names[i] + ",'" + loc + "'," + streets[i] + "," + bdates[i] + "," + SSN[i] + "," + AFM[
                i] + "," + phones[i] + "," + specialty[i] + "," + depart[i] + "," + hire_date[i] + "," + salary[
                i] + "," + hoursperweek[i] + "," + vacation[i] + "," + str(clinicID) + ");")

    return (full, ID, idlist, cnames, cstreets, cSSN, cAFM, cID, cphones)


def pCode(number):
    plist = []
    for i in range(0, number):
        code = str(10000000 + int(round(100000000 * rd.random())))
        while code in plist:
            code = pCode(1)[0]
        plist.append(code)
    return plist


def giveRandomDateInAndOut(number):
    dateList = []

    for i in range(0, number):
        year = str(2018 + int(round(0.8 * rd.random())))
        month = str(int(round(1 + 11 * rd.random())))
        day = int(round(1 + 12 * rd.random()))
        dateList.append("'" + year + "-" + month + "-" + str(day) + "','" + year + "-" + month + "-" + str(
            day + int(round(7 * rd.random()))) + "'")
    return dateList


def giveRoomNumber(number, maxflr):
    flList = []

    for i in range(0, number):
        flr = str(int(round(1 + maxflr * rd.random())))
        rnmbr = flr + str(int(round(1 * rd.random()))) + str(int(round(9 * rd.random())))

        while rnmbr in flList:
            rnmbr = giveRoomNumber(1, maxflr)[0]
        flList.append(rnmbr)

    return flList


def patients(number, doctorIDs, doctorSpecialty, floors, clinicID, checkNames=[], checkStreets=[], checkAFM=[],
             checkSSN=[], checkID=[], checkPhone=[]):
    full_names, b = giveMixed(number, checkNames)
    cnames = full_names
    for i in checkNames:
        cnames.append(i)
    rd.shuffle(full_names)

    loc = []
    for i in range(0, number):
        loc.append(giveRandomLocation(1, checkStreets)[0])

    leadDoctor, condition = giveDoctor(number, doctorIDs, doctorSpecialty)

    SSN = giveRandomSSN(number, checkSSN)
    cSSN = SSN
    for i in checkSSN:
        cSSN.append(i)

    AFM = giveRandomAFM(number, checkAFM)
    cAFM = AFM
    for i in checkAFM:
        cAFM.append(i)

    ID = giveRandomID(number, checkID)
    cID = ID
    for i in checkID:
        cID.append(i)

    pcode = pCode(number)

    inandout = giveRandomDateInAndOut(number)

    bdates = giveRandomDate(number, 1940, 54)

    roomNumbers = giveRoomNumber(number, floors)

    phones = givePhoneNumber(number, checkPhone)

    cphones = phones
    for i in checkPhone:
        cphones.append(i)

    payFee = []
    for i in range(0, number):
        payFee.append(str(int(round(0.6 * rd.random()) * round(10000 * rd.random()))))

    bloodType = giveRandomBlood(number)

    hire_date = giveRandomDate(number - 8, 2010, 1)
    for i in range(0, 8):
        hire_date.append(giveRandomDate(1, 2010, i)[0])

    full = []

    for i in range(0, number - 1):
        full.append(
            "INSERT INTO patients(patient_code,id,name,surname,gender,addr_city,addr_street,addr_number,birth_date,amka,afm,telephone,admission_reason,attended_by,admission_date,discharge_date,blood_type,patient_room,current_fee,patient_clinic_id) VALUES (" +
            pcode[i] + "," + ID[i] + "," + full_names[i] + ",'" + loc[i] + "'," + bdates[i] + "," + SSN[i] + "," + AFM[
                i] + "," + phones[i] + "," + condition[i] + "," + leadDoctor[i] + "," + inandout[i] + "," + bloodType[
                i] + "," + roomNumbers[i] + "," + payFee[i] + "," + str(clinicID) + ");")

    return (full, cnames, cstreets, cSSN, cAFM, cID, cphones, pcode)


relationships = ["'Sygenis'", "'Filos/Fili'"]


def EmergencyContact(number, pcodes):
    names, _ = giveMixed(number)
    rd.shuffle(names)
    full = []
    for i in range(0, number - 1):
        full.append(
            "INSERT INTO emergency_contacts(name,surname,telephone,relationship,cont_patient_code) VALUES (" + names[
                i] + "," + str(givePhoneNumber(1)[0]) + "," + rd.choice(relationships) + "," + pcodes[i] + ");")
    return full


eqnames = ["'Tomografos", "'Magnhtikh", "'Yperixos"]
eqtypes = ["'Axonikos Tomografos'", "'Magnhtikh'", "'Yperixos'"]
enms = ["A", "AA", "B", "BB", "C", "CC", "D", "DD", "E", "EE", "F", "FF"]


def equipments(number, clinicid):
    nlist = []
    tlist = []
    for i in range(0, number):
        nmb = int(round(2 * rd.random()))
        nlist.append(eqnames[nmb] + " " + rd.choice(enms) + rd.choice(enms) + "'")
        tlist.append(eqtypes[nmb])
    full = []
    for i in range(0, number):
        full.append(
            "INSERT INTO equipment(name,type,state,clinic_id) VALUES (" + nlist[i] + "," + tlist[i] + ",0," + str(
                clinicid) + ");")
    return full


mednames = ["'Sensijex'", "'Olsanazol'", "'Chlortora'", "'Fexomicin'", "'Acetylprex'", "'Terconorphine'",
            "'Roxanavir'" "'Nizosyn'", "'Nedotriene'", "'Acitrerall'", "'Thyroriva Acetyltropin'",
            "'Oxycotrim Naftimine'"]
medtype = ["'Hormonal'", "'Painkiller'", "'Blood Thickening'", "'Anesthysia'"]
medsub = ["'Sensil'", "'Olsanozil'", "'Chlortoril'", "'Fexomicinil'", "'Acetylprexil'", "'Terconorphinil'", "'Roxanil'",
          "'Nizosynil'", "'Nedotrienil'", "'Acitreril'", "'Thyrovil'", "'Oxycotril'"]


def medicines(number, clinicId):
    mlist = []
    for i in range(0, number):
        nmb = int(round(10 * rd.random()))
        mlist.append(mednames[nmb] + "," + rd.choice(medtype) + "," + medsub[nmb])
    full = []
    for i in range(0, number):
        full.append("INSERT INTO medications(name,type,active_substance,quantity,price,clinic_id) VALUES (" + mlist[
            i] + "," + str(int(round(99 * rd.random()))) + "," + str(int(round(999 * rd.random()))) + "," + str(
            clinicId) + ");")
    return full


roomCap = ["2", "4", "6"]
roomPay = ["125", "80", "45"]


def rooms(wrid, wid, flrs, clinicID):
    rList = []
    flList = []
    capList = []
    payList = []
    roomNurse = []
    nursesIDs = []

    for i in range(0, len(wid)):
        if wid[i] == 0:
            nursesIDs.append(wrid[i])

    for i in range(1, flrs + 1):
        for j in [0, 1]:
            for k in range(0, 10):
                rList.append(str(i) + str(j) + str(k))
                flList.append(str(i))
                nmbr = int(round(2 * rd.random()))
                capList.append(roomCap[nmbr])
                payList.append(roomPay[nmbr])
                roomNurse.append(rd.choice(nursesIDs))
    full = []
    for i in range(0, len(rList)):
        full.append(
            "INSERT INTO rooms(number,floor,capacity,number_patients,price,clinic_id) VALUES (" + rList[i] + "," +
            flList[i] + "," + capList[i] + ",0," + payList[i] + "," + str(clinicID) + ");")

    return full, roomNurse, rList


def responsible(roomNurse, room, clinicID):
    full = []
    for i in range(0, len(room)):
        full.append("INSERT INTO responsibles(nurse_id,room_clinic_id,room_number) VALUES (" + roomNurse[i] + "," + str(
            clinicID) + "," + room[i] + ");")
    return full


def departments(dpr, clinicID):
    full = []
    for i in range(0, len(dpr)):
        full.append(
            "INSERT INTO departments(name,number_employees,clinic_id) VALUES (" + dpr[i] + ",0," + str(clinicID) + ");")
    return full

empA,idA,idlstA,cnames,cstreets,cSSN,cAFM,cID,cphones=employees(20,"Xanthi",1)
patA,cnames,cstreets,cSSN,cAFM,cID,cphones,pcodeA=patients(12,idA,idlstA,3,1,cnames,cstreets,cAFM,cSSN,cID,cphones)
econA=EmergencyContact(12,pcodeA)
rmsA,rnA,rmA=rooms(idA,idlstA,3,1)
medsA = medicines(3,1)
respA = responsible(rnA,rmA,1)
departA = departments(department,1)
eqA=equipments(3,1)

empB,idB,idlstB,cnames,cstreets,cSSN,cAFM,cID,cphones=employees(28,"Alexandroupoli",2,cnames,cstreets,cAFM,cSSN,cID,cphones)
patB,cnames,cstreets,cSSN,cAFM,cID,cphones,pcodeB=patients(18,idB,idlstB,5,2,cnames,cstreets,cAFM,cSSN,cID,cphones)
econB=EmergencyContact(18,pcodeB)
rmsB,rnB,rmB=rooms(idB,idlstB,5,2)
medsB = medicines(6,2)
respB = responsible(rnB,rmB,2)
departB = departments(department,2)
eqB=equipments(5,2)

empC,idC,idlstC,cnames,cstreets,cSSN,cAFM,cID,cphones=employees(35,"Kavala",3,cnames,cstreets,cAFM,cSSN,cID,cphones)
patC,cnames,cstreets,cSSN,cAFM,cID,cphones,pcodeC=patients(21,idC,idlstC,3,3,cnames,cstreets,cAFM,cSSN,cID,cphones)
econC=EmergencyContact(21,pcodeC)
rmsC,rnC,rmC=rooms(idC,idlstC,3,3)
medsC = medicines(3,3)
respC = responsible(rnC,rmC,3)
departC = departments(department,3)
eqC=equipments(8,3)

empD,idD,idlstD,cnames,cstreets,cSSN,cAFM,cID,cphones=employees(41,"Kavala",4,cnames,cstreets,cAFM,cSSN,cID,cphones)
patD,cnames,cstreets,cSSN,cAFM,cID,cphones,pcodeD=patients(25,idD,idlstD,5,4,cnames,cstreets,cAFM,cSSN,cID,cphones)
econD=EmergencyContact(25,pcodeD)
rmsD,rnD,rmD=rooms(idD,idlstD,5,4)
medsD = medicines(6,4)
respD = responsible(rnD,rmD,4)
departD = departments(department,4)
eqD=equipments(5,4)

empE,idE,idlstE,cnames,cstreets,cSSN,cAFM,cID,cphones=employees(37,"Kommotini",5,cnames,cstreets,cAFM,cSSN,cID,cphones)
patE,cnames,cstreets,cSSN,cAFM,cID,cphones,pcodeE=patients(19,idE,idlstE,4,5,cnames,cstreets,cAFM,cSSN,cID,cphones)
econE=EmergencyContact(19,pcodeE)
rmsE,rnE,rmE=rooms(idE,idlstE,4,5)
medsE = medicines(5,5)
respE = responsible(rnE,rmE,5)
departE = departments(department,5)
eqE=equipments(7,5)

hospitals = np.array([[empA,patA,econA,rmsA,medsA,respA,departA,eqA],[empB,patB,econB,rmsB,medsB,respB,departB,eqB],[empC,patC,econC,rmsC,medsC,respC,departC,eqC],[empD,patD,econD,rmsD,medsD,respD,departD,eqD],[empE,patE,econE,rmsE,medsE,respE,departE,eqE]])

for i in range(0,len(hospitals)):
  for j in hospitals[i]:
    for k in j:
      print(k)
    print(" ")