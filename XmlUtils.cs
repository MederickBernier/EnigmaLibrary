using System.Xml.Serialization;

namespace EnigmaLibrary;
public static class XmlUtils {
    public static string SerializeToXml<T>(T obj) {
        XmlSerializer xmlSerializer = new XmlSerializer(typeof(T));
        using (StringWriter sw = new StringWriter()) {
            xmlSerializer.Serialize(sw, obj);
            return sw.ToString();
        }
    }

    public static T DeserializeFromXml<T>(string xml) {
        XmlSerializer serializer = new XmlSerializer(typeof(T));
        using (StringReader sr = new StringReader(xml)) {
            return (T)serializer.Deserialize(sr);
        }
    }
}
