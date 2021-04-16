export class ArrayUtil {
    public static search(name: string, value: string, arrayData: Array<any>): any {
        //console.log(arrayData)
        for (const key in arrayData) {
            //console.log(arrayData[key][name])
            if (arrayData[key][name] == value) {
                return arrayData[key];
            }
        }
    }
}