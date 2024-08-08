using System.Xml.Serialization;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for XML serialization and deserialization.
    /// </summary>
    public static class ELXml {
        /// <summary>
        /// Serializes an object to an XML string.
        /// </summary>
        /// <typeparam name="T">The type of the object to serialize.</typeparam>
        /// <param name="obj">The object to serialize to XML.</param>
        /// <returns>An XML string representing the serialized object.</returns>
        public static string SerializeToXml<T>(T obj) {
            // Create an XmlSerializer for the specified type
            XmlSerializer xmlSerializer = new XmlSerializer(typeof(T));

            // Use a StringWriter to write the serialized XML data to a string
            using (StringWriter sw = new StringWriter()) {
                xmlSerializer.Serialize(sw, obj);
                return sw.ToString();
            }
        }

        /// <summary>
        /// Deserializes an XML string to an object of the specified type.
        /// </summary>
        /// <typeparam name="T">The type of the object to deserialize to.</typeparam>
        /// <param name="xml">The XML string to deserialize.</param>
        /// <returns>An object of type T deserialized from the XML string.</returns>
        public static T DeserializeFromXml<T>(string xml) {
            // Create an XmlSerializer for the specified type
            XmlSerializer serializer = new XmlSerializer(typeof(T));

            // Use a StringReader to read the XML string and deserialize it into an object of type T
            using (StringReader sr = new StringReader(xml)) {
                return (T)serializer.Deserialize(sr);
            }
        }
    }
}
