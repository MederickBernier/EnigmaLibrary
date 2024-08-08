namespace EnigmaLibrary.Utils;
public static class ELException {
    public static string GetExceptionDetails(Exception e) {
        return $"Exception: {e.Message}{Environment.NewLine}StackTrace: {e.StackTrace}";
    }

    public static string GetInnerExceptionDetails(Exception ex) {
        return ex.InnerException != null ? GetExceptionDetails(ex.InnerException) : "No inner exception";
    }

    public static void HandleException(Exception ex) {
        ELLogging.LogError(GetExceptionDetails(ex));
    }
}
